<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use Illuminate\Http\Request;
use App\Models\Product;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stocks = StockMovement::with(['product', 'user'])
            ->latest()
            ->paginate(10);
        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $products = Product::orderBy('name')->get();
        return view('stocks.create', compact('products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'movement_type' => ['required', 'in:addition,removal'],
            'note' => ['nullable' , 'string', 'max:1000']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(StockMovement $stock)
    {
        //
        $stock -> load(['product', 'user']);
        return view('stocks.show', compact('stock'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockMovement $stock)
    {
        //
        $products = Product::orderBy('name')->get();
        return view('stocks.edit', compact('stock', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockMovement $stock)
    {
        //
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'movement_type' => ['required', 'in:addition,removal'],
            'note' => ['nullable', 'string', 'max:1000']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockMovement $stock)
    {
        //
        $stock = StockMovement::findOrFail($stock->id);
        $stock->delete();

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock movement deleted successfully.');
    }
}
