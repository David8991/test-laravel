<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

# Заказы
Route::resource('orders', OrdersController::class);

# Обновление статуса заказа
Route::patch('orders/{order}/complete', [OrdersController::class, 'complete'])->name('orders.complete');

# Товары
Route::resource('products', ProductsController::class);
