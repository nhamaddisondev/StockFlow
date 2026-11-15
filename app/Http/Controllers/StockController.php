<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockController extends Controller
{
    public function index()
    {
        $stocks = StockMovement::with(['product', 'user'])
            ->latest()
            ->paginate(10);

        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stocks.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedMovement($request);

        DB::transaction(function () use ($data, $request) {
            $product = Product::whereKey($data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $this->applyMovement($product, $data['movement_type'], $data['quantity']);
            $product->save();

            $product->stockMovements()->create([
                ...$data,
                'user_id' => $request->user()->id,
            ]);
        });

        return redirect()->route('stocks.index')->with('success', 'Stock movement recorded.');
    }

    public function show(StockMovement $stock)
    {
        $stock->load(['product', 'user']);

        return view('stocks.show', compact('stock'));
    }

    public function edit(StockMovement $stock)
    {
        $products = Product::orderBy('name')->get();

        return view('stocks.edit', compact('stock', 'products'));
    }

    public function update(Request $request, StockMovement $stock)
    {
        $data = $this->validatedMovement($request);

        DB::transaction(function () use ($data, $stock) {
            $movement = StockMovement::whereKey($stock->id)
                ->lockForUpdate()
                ->firstOrFail();

            $productIds = collect([$movement->product_id, $data['product_id']])
                ->unique()
                ->sort()
                ->values();

            $products = Product::whereIn('id', $productIds)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $oldProduct = $products->get($movement->product_id);
            $newProduct = $products->get($data['product_id']);

            // Reverse the existing movement in memory before applying the edited one.
            if ($movement->movement_type === 'in') {
                $this->ensureEnoughStockToReverse($oldProduct, $movement->quantity);
                $oldProduct->stock_quantity -= $movement->quantity;
            } else {
                $oldProduct->stock_quantity += $movement->quantity;
            }

            $this->applyMovement($newProduct, $data['movement_type'], $data['quantity']);

            $products->each(fn (Product $product) => $product->save());
            $movement->update($data);
        });

        return redirect()->route('stocks.index')->with('success', 'Stock movement updated.');
    }

    public function destroy(StockMovement $stock)
    {
        DB::transaction(function () use ($stock) {
            $movement = StockMovement::whereKey($stock->id)
                ->lockForUpdate()
                ->firstOrFail();

            $product = Product::whereKey($movement->product_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($movement->movement_type === 'in') {
                $this->ensureEnoughStockToReverse($product, $movement->quantity);
                $product->stock_quantity -= $movement->quantity;
            } else {
                $product->stock_quantity += $movement->quantity;
            }

            $product->save();
            $movement->delete();
        });

        return redirect()->route('stocks.index')->with('success', 'Stock movement deleted.');
    }

    private function validatedMovement(Request $request): array
    {
        return $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'movement_type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);
    }

    private function applyMovement(Product $product, string $type, int $quantity): void
    {
        if ($type === 'out' && $product->stock_quantity < $quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'There is not enough stock for this movement.',
            ]);
        }

        $product->stock_quantity += $type === 'in' ? $quantity : -$quantity;
    }

    private function ensureEnoughStockToReverse(Product $product, int $quantity): void
    {
        if ($product->stock_quantity < $quantity) {
            throw ValidationException::withMessages([
                'stock' => 'This movement cannot be reversed because some of its stock has already been used.',
            ]);
        }
    }
}
