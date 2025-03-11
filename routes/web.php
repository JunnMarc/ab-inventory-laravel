<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('orders', OrdersController::class);

Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');

Route::resource('suppliers', SupplierController::class);

Route::resource('purchases', PurchaseController::class);

require __DIR__.'/auth.php';
