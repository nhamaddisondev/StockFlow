<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\StockController;


Route::get('/', function () {
    return view('/welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalProducts' => 124,
        'totalCategories' => 8,
        'lowStockCount' => 5,
        'totalStockUnits' => 1250,
        'recentMovements' => collect(),
        'lowStockProducts' => collect(),
    ]);
})->name('dashboard');

// Route::middleware('auth')->group(function (){

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });