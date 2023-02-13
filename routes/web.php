<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',[HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'categories'],function(){
    Route::get('/',[CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::delete('/softdeletes/{id}', [CategoryController::class, 'softdeletes'])->name('category.softdeletes');
    Route::get('/trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::get('/restoredelete/{id}', [CategoryController::class, 'restoredelete'])->name('category.restoredelete');
});
Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::delete('/softdeletes/{id}', [ProductController::class, 'softdeletes'])->name('product.softdeletes');
    Route::get('/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('/restoredelete/{id}', [ProductController::class, 'restoredelete'])->name('product.restoredelete');
});
//khách hàng
Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
});
//đơn hàng
Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('order.index');
    Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('order.detail');
});
//xuất exports
Route::get('/xuat', [OrderController::class, 'exportOrder'])->name('xuat');
