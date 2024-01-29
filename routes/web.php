<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CartController;
use App\Http\Controllers\Backend\CashierController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CheckoutController;
use App\Http\Controllers\Backend\DashboardController;

Route::get('/', [AuthController::class, 'domain']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin-login', [AuthController::class, 'userLogin'])->name('userLogin');

Route::middleware(['auth'])->group(function() {
  Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

  //Category
  Route::get('/categories', [CategoryController::class, 'index'])->name('category');
  Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
  Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
  Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
  Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
  Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('category.delete');

  //Product
  Route::get('/products', [ProductController::class, 'index'])->name('product');
  Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
  Route::post('/products', [ProductController::class, 'store'])->name('product.store');
  Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
  Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
  Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('product.delete');
  Route::get('/barcode/{id}', [ProductController::class, 'barcode'])->name('product.barcode');

  //invoice
  //Category
  Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice');
  Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

  Route::get('/cashiers', [CashierController::class, 'index'])->name('cashier');
  Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout');

  Route::post('/carts', [CartController::class, 'store'])->name('cart.store');
  Route::put('/change-quantity/{id}', [CartController::class, 'changeQuantity']);
  Route::delete('/carts/{id}', [CartController::class, 'delete'])->name('cart.delete');
  Route::get('/cart-total-prices', [CartController::class, 'cartTotalPrices']);

  Route::get('/pos/print/{id}', [GeneralController::class, 'posPrint']);
  Route::get('/barcode/print/{id}', [GeneralController::class, 'printBarcode']);
});