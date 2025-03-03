<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SiparisController;
use Illuminate\Support\Facades\Auth;

// Ana sayfa
Route::get('/', [HomeController::class, 'index'])->name('home');

// Kimlik doğrulama route'ları
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->middleware('guest');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');

// Cart 
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

// Checkout routes
Route::post('checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Order success route
Route::get('success', [CheckoutController::class, 'success'])->name('success');

// Admin route group with middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Stock routes
    Route::get('/admin/stok', [StokController::class, 'index'])->name('admin.stok');
    Route::post('/admin/stok', [StokController::class, 'store']);
    Route::put('/admin/stok/{id}', [StokController::class, 'update'])->name('stok.update');
    Route::delete('/admin/stok/{id}', [StokController::class, 'destroy'])->name('stok.destroy');
    
    // Order routes
    Route::get('/admin/siparis', [SiparisController::class, 'index'])->name('admin.siparis');
    Route::post('/admin/siparis', [SiparisController::class, 'store'])->name('siparis.store');
});