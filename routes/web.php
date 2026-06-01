<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\PaymentCallbackController;
use Illuminate\Support\Facades\Route;

// 1. Customer Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategori', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

// 2. Customer Auth Routes (Carts & Checkout)
Route::middleware(['auth'])->group(function () {
    // Profile Management (Breeze standard)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Management
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah', [CartController::class, 'store'])->name('cart.store');
    Route::post('/keranjang/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/hapus/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout & Order Management
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/proses', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/riwayat-pesanan', [CheckoutController::class, 'history'])->name('orders.index');
    Route::get('/pesanan/{order_code}', [CheckoutController::class, 'show'])->name('orders.show');
});

// Redirect default dashboard route to homepage or appropriate place based on role
Route::get('/dashboard', function () {
    if (auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home')->with('success', 'Selamat datang kembali!');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Admin Backend Routes (Protected by Auth and AdminMiddleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Category Management CRUD
    Route::resource('categories', AdminCategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy',
    ]);

    // Product Management CRUD
    Route::resource('products', AdminProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);

    // Order Management
    Route::get('/orders', [AdminDashboardController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{id}', [AdminDashboardController::class, 'orderShow'])->name('orders.show');
    Route::post('/orders/{id}/status', [AdminDashboardController::class, 'orderUpdateStatus'])->name('orders.updateStatus');
});

// Midtrans Webhook Callback
Route::post('/midtrans/callback', [PaymentCallbackController::class, 'receive']);

require __DIR__ . '/auth.php';
