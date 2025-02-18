<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\HomePageController::class)->name('home');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::get('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [\App\Http\Controllers\CartController::class, 'createOrder']);
Route::get('/order-submitted', [\App\Http\Controllers\CartController::class, 'orderSubmitted'])->name('order');
Route::get('/page/{page:slug}', \App\Http\Controllers\PageController::class)->name('page');
Route::get('/product/{product:slug}', \App\Http\Controllers\ProductController::class)->name('product');
Route::get('/category/{productCategory:slug}', \App\Http\Controllers\CategoryController::class)->name('category');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
