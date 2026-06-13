<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\MidtransController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// **AUTHENTICATION (LOGIN, REGISTER, LOGOUT)**
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// **REGISTRASI HANYA UNTUK CUSTOMER**
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// **DASHBOARD (Admin & Owner)**
Route::middleware(['auth', CheckUserType::class . ':admin,owner'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// **ADMIN: Kelola Produk, Kategori, dan Pesanan**
Route::middleware(['auth', CheckUserType::class . ':admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // Orders Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit'); // Edit order
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update'); // Update order
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Hapus order
});

// **OWNER: Laporan & Grafik**
Route::middleware(['auth', CheckUserType::class . ':owner'])->group(function () {
    Route::get('/laporan/penjualan', [LaporanController::class, 'penjualan'])->name('laporan.penjualan');
    Route::get('/chart', [ChartController::class, 'showChart'])->name('chart');
    Route::get('/download-sales-report', [PDFController::class, 'download'])->name('download');
});

// Kelola Users
Route::resource('users', UserController::class);

// **Customer Menu & Catalog**
Route::get('/menu', [CustomerController::class, 'menu'])->name('menu');
Route::get('/catalog', [CustomerController::class, 'catalog'])->name('catalog');

// Cart View
Route::get('/cart', function () {
    return view('customer.menu.cart');
})->name('cart');

// **Checkout untuk Customer**
Route::middleware(['auth'])->group(function () {
    Route::post('/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
});
Route::get('/menu/checkout', function () {
    return view('customer.menu.checkout');
})->name('checkout.success');


Route::post('/midtrans-token', [MidtransController::class, 'transaksi'])->name('midtrans.token');
Route::post('/update-status', [MidtransController::class, 'updateStatus'])->name('update.status');
Route::post('/update-status2', [MidtransController::class, 'updateStatus2'])->name('update.status2');
