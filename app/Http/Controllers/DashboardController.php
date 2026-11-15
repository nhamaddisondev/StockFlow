<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'min_stock')
            ->orderBy('stock_quantity')
            ->take(5)
            ->get();
        $lowStockCount = Product::whereColumn('stock_quantity', '<=', 'min_stock')->count();
        $totalStockUnits = Product::sum('stock_quantity');
        $recentMovements = StockMovement::with('product')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'lowStockCount',
            'totalStockUnits',
            'recentMovements',
            'lowStockProducts',
        ));
    }

}
