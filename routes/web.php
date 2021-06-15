<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');

Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store']);

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store']);

Route::get('/payment/error', function () {
    return view('payments.error');
})->name('payments.error');
