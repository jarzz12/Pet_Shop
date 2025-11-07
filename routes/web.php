<?php

use App\Http\Controllers\{
    HomeController,
    ProductController,
    CategoryController,
    CartController,
    OrderController,
    AdminController
};
use Illuminate\Support\Facades\Route;

// --- Load Auth Routes (from Breeze) ---
require __DIR__.'/auth.php';

// Guest Routes (Semua bisa akses)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Routes yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    // Dashboard User Biasa (diupdate URL-nya)
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            // Jika admin login ke /dashboard, redirect ke admin dashboard
            return redirect()->route('admin.dashboard');
        }
        // Jika user biasa, tampilkan view dashboard
        return view('dashboard');
    })->name('dashboard'); // Nama route tetap 'dashboard' untuk kemudahan

    // Cart Routes
    Route::resource('cart', CartController::class);
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
});

// Routes untuk Admin (membutuhkan login + role:admin)
// Prefix 'admin' berarti semua route di dalam grup ini akan diawali dengan '/admin'
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route ini sekarang menjadi /admin/dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // CRUD Products (misalnya di folder Admin)
    // Route ini menjadi /admin/products, /admin/products/create, dll
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    
    // CRUD Categories (misalnya di folder Admin)
    // Route ini menjadi /admin/categories, /admin/categories/create, dll
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    
    // Orders Management
    // Route ini menjadi /admin/orders
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    // Route ini menjadi /admin/orders/{id}/status
    Route::patch('/orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// Catatan: Kode di bawah ini sekarang sudah digabungkan ke dalam grup middleware(['auth']) di atas.
// Komentar ini untuk menjelaskan bahwa logika dashboard sekarang terintegrasi.
// Jika Anda ingin dashboard user biasa memiliki URL yang berbeda (misalnya /user-dashboard),
// Anda bisa memindahkan definisi route dashboard ke sini dan mengganti URL-nya.
/*
Route::middleware(['auth'])->group(function () {
    Route::get('/user-dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('user.dashboard'); // Ganti nama route jika URL-nya berbeda
});
*/