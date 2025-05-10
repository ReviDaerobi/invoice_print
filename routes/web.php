<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\costumerController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PoController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\quatationController;
use Illuminate\Support\Facades\Route;

// Halaman Landing
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
});

// Protected Routes (Memerlukan Authentication)
Route::middleware('auth')->group(function () {
    // Add this to your routes/api.php
    // Route::get('/customers/{id}', [costumerController::class, 'getDetails']);
    // Route::get('/customers/{id}', 'costumerController@getCustomerDetails');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    // INVOICES
    Route::get('/invoices', [InvoiceController::class, 'invoice'])->name('invoice');
    Route::get('/invoices/create', [InvoiceController::class, 'createPage'])->name('invoiceCreate');
    Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('invoice.store'); // For storing
    Route::get('/invoices/detail/{id}', [InvoiceController::class, 'detailPage'])->name('invoice.detail');
    Route::get('/invoices/edit/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::put('/invoices/update/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/delete/{id}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');

    // Produk
    Route::get('/produk', [produkController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [produkController::class, 'createPage'])->name('ProdukCreate');
    Route::post('/produk/store', [produkController::class, 'store'])->name('produk.store');
    Route::get('/produk/detail/{id}', [produkController::class, 'detailPage'])->name('ProdukDetail');
    Route::get('/edit/{id}', [produkController::class, 'edit'])->name('produk.edit');
    Route::put('/update/{id}', [produkController::class, 'update'])->name('produk.update');
    Route::delete('/delete/{id}', [produkController::class, 'destroy'])->name('produk.destroy');
    // Costumers
    Route::get('/customers', [costumerController::class, 'index'])->name('costumer');
    Route::get('/customers/create', [costumerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [costumerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}', [costumerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{id}/edit', [costumerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [costumerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [costumerController::class, 'destroy'])->name('customers.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Delivery Order
    Route::get('/delivery-order', [DeliveryOrderController::class, 'index'])->name('deliveryOrders');
    Route::get('/delivery-order/create', [DeliveryOrderController::class, 'create'])->name('delivery-order.create');
    Route::post('/delivery-order/store', [DeliveryOrderController::class, 'store'])->name('delivery-order.store');
    Route::get('/delivery-order/show/{id}', [DeliveryOrderController::class, 'show'])->name('delivery-order.show');
    Route::get('/delivery-order/edit/{id}', [DeliveryOrderController::class, 'edit'])->name('delivery-order.edit');
    Route::post('/delivery-order/update/{id}', [DeliveryOrderController::class, 'update'])->name('delivery-order.update');
    Route::delete('/delivery-order/destroy/{id}', [DeliveryOrderController::class, 'destroy'])->name('delivery-order.destroy');

    // po
    Route::resource('PO', PoController::class);
    
    // another route
    Route::resource('quatation', quatationController::class);
    
    // another route
});