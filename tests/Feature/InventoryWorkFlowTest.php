<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class InventoryWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_inventory_pages(): void
    {
        foreach ([
            'dashboard',
            'products.index',
            'categories.index',
            'stocks.index',
            'users.index',
        ] as $routeName) {
            $this->get(route($routeName))
                ->assertRedirect(route('login'));
        }
    }

    public function test_user_can_create_a_category_then_a_product(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('categories.store'), [
            'name' => 'Office supplies',
            'description' => 'Items for the office',
        ])->assertRedirect();

        $category = Category::where('name', 'Office supplies')->firstOrFail();

        $this->post(route('products.store'), [
            'category_id' => $category->id,
            'name' => 'Notebook',
            'sku' => 'NOTEBOOK-001',
            'price' => 3.50,
            'min_stock' => 5,
        ])->assertRedirect();

        $this->assertDatabaseHas('products', [
            'category_id' => $category->id,
            'name' => 'Notebook',
            'sku' => 'NOTEBOOK-001',
            'stock_quantity' => 0,
        ]);
    }

    public function test_stock_increases_when_stock_in_is_recorded(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct();

        $this->actingAs($user)
            ->post(route('stocks.store'), [
                'product_id' => $product->id,
                'movement_type' => 'in',
                'quantity' => 10,
                'note' => 'Initial delivery',
            ])
            ->assertRedirect(route('stocks.index'));

        $this->assertSame(10, $product->fresh()->stock_quantity);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'movement_type' => 'in',
            'quantity' => 10,
            'note' => 'Initial delivery',
        ]);
    }

    public function test_stock_decreases_when_stock_out_is_recorded(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct(['stock_quantity' => 10]);

        $this->actingAs($user)
            ->post(route('stocks.store'), [
                'product_id' => $product->id,
                'movement_type' => 'out',
                'quantity' => 4,
            ])
            ->assertRedirect(route('stocks.index'));

        $this->assertSame(6, $product->fresh()->stock_quantity);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'movement_type' => 'out',
            'quantity' => 4,
        ]);
    }

    public function test_stock_out_is_rejected_when_there_is_not_enough_stock(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct(['stock_quantity' => 3]);

        $this->actingAs($user)
            ->from(route('stocks.create'))
            ->post(route('stocks.store'), [
                'product_id' => $product->id,
                'movement_type' => 'out',
                'quantity' => 4,
            ])
            ->assertRedirect(route('stocks.create'))
            ->assertSessionHasErrors('quantity');

        $this->assertSame(3, $product->fresh()->stock_quantity);
        $this->assertDatabaseMissing('stock_movements', [
            'product_id' => $product->id,
            'movement_type' => 'out',
            'quantity' => 4,
        ]);
    }

    public function test_editing_a_movement_updates_the_product_quantity(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct(['stock_quantity' => 10]);

        $movement = StockMovement::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'movement_type' => 'in',
            'quantity' => 10,
        ]);

        $this->actingAs($user)
            ->put(route('stocks.update', $movement), [
                'product_id' => $product->id,
                'movement_type' => 'in',
                'quantity' => 8,
                'note' => 'Corrected delivery count',
            ])
            ->assertRedirect(route('stocks.index'));

        $this->assertSame(8, $product->fresh()->stock_quantity);
        $this->assertSame(8, $movement->fresh()->quantity);
    }

    public function test_deleting_a_movement_reverses_its_stock_change(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct(['stock_quantity' => 10]);

        $movement = StockMovement::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'movement_type' => 'in',
            'quantity' => 10,
        ]);

        $this->actingAs($user)
            ->delete(route('stocks.destroy', $movement))
            ->assertRedirect(route('stocks.index'));

        $this->assertSame(0, $product->fresh()->stock_quantity);
        $this->assertDatabaseMissing('stock_movements', ['id' => $movement->id]);
    }

    public function test_only_admins_can_access_the_users_page(): void
    {
        $regularUser = User::factory()->create();

        $this->actingAs($regularUser)
            ->get(route('users.index'))
            ->assertForbidden();

        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        $this->actingAs($admin)
            ->get(route('users.index'))
            ->assertOk();
    }

    public function test_product_with_movement_history_cannot_be_deleted(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct(['stock_quantity' => 5]);

        StockMovement::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'movement_type' => 'in',
            'quantity' => 5,
        ]);

        $this->actingAs($user)
            ->from(route('products.show', $product))
            ->delete(route('products.destroy', $product))
            ->assertRedirect(route('products.show', $product))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_category_with_products_cannot_be_deleted(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Tools',
            'description' => null,
        ]);

        $this->makeProduct(['category_id' => $category->id]);

        $this->actingAs($user)
            ->from(route('categories.show', $category))
            ->delete(route('categories.destroy', $category))
            ->assertRedirect(route('categories.show', $category))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    private function makeProduct(array $attributes = []): Product
    {
        $category = Category::create([
            'name' => 'Test category '.Str::uuid(),
            'description' => null,
        ]);

        return Product::create(array_merge([
            'category_id' => $category->id,
            'name' => 'Test product',
            'sku' => 'SKU-'.Str::uuid(),
            'price' => 10.00,
            'stock_quantity' => 0,
            'min_stock' => 5,
        ], $attributes));
    }
}