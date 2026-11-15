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
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'movement_type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($data, $request) {
            $product = Product::whereKey($data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($data['movement_type'] === 'out'
                && $product->stock_quantity < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'There is not enough stock for this movement.',
                ]);
            }

            $product->stock_quantity += $data['movement_type'] === 'in'
                ? $data['quantity']
                : -$data['quantity'];

            $product->save();

            StockMovement::create([
                ...$data,
                'user_id' => $request->user()->id,
            ]);
        });

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock movement recorded.');
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
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'movement_type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($data, $stock) {
            $stock = StockMovement::whereKey($stock->id)
                ->lockForUpdate()
                ->firstOrFail();

            $oldProduct = Product::whereKey($stock->product_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Reverse the original movement.
            $oldProduct->stock_quantity += $stock->movement_type === 'in'
                ? -$stock->quantity
                : $stock->quantity;

            $oldProduct->save();

            $newProduct = Product::whereKey($data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($data['movement_type'] === 'out'
                && $newProduct->stock_quantity < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'There is not enough stock for this movement.',
                ]);
            }

            // Apply the edited movement.
            $newProduct->stock_quantity += $data['movement_type'] === 'in'
                ? $data['quantity']
                : -$data['quantity'];

            $newProduct->save();
            $stock->update($data);
        });

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock movement updated.');
    }

    public function destroy(StockMovement $stock)
    {
        DB::transaction(function () use ($stock) {
            $stock = StockMovement::whereKey($stock->id)
                ->lockForUpdate()
                ->firstOrFail();

            $product = Product::whereKey($stock->product_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Reverse the movement before removing its record.
            $product->stock_quantity += $stock->movement_type === 'in'
                ? -$stock->quantity
                : $stock->quantity;

            $product->save();
            $stock->delete();
        });

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock movement deleted.');
    }
}