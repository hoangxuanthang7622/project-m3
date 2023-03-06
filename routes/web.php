<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
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
// đáng nhập admin

Route::get('/login', [UserController::class, 'viewLogin'])->name('login');
Route::post('handdle-login', [UserController::class, 'login'])->name('handdle-login');
//ngăn chặn
Route::middleware(['auth' , 'prevent-back-history'])->group(function(){
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/',[HomeController::class, 'index'])->name('home');
//thể loại
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
//sản phẩm
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
//Chức vụ
Route::group(['prefix' => 'groups'], function () {
    Route::get('/', [GroupController::class, 'index'])->name('group.index');
    Route::get('/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/store', [GroupController::class, 'store'])->name('group.store');
    Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
    Route::put('/update/{id}', [GroupController::class, 'update'])->name('group.update');
    Route::delete('destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy');
 // trao quyền
    Route::get('/detail/{id}', [GroupController::class, 'detail'])->name('group.detail');
    Route::put('/group_detail/{id}', [GroupController::class, 'group_detail'])->name('group.group_detail');
});
//nhân sự
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/editpass/{id}', [UserController::class, 'editpass'])->name('user.editpass');
    Route::put('/updatepass/{id}', [UserController::class, 'updatepass'])->name('user.updatepass');
    Route::get('/adminpass/{id}', [UserController::class, 'adminpass'])->name('user.adminpass');
    Route::put('/adminUpdatePass/{id}', [UserController::class, 'adminUpdatePass'])->name('user.adminUpdatePass');
});
});
//shop
Route::prefix('shop')->group(function () {
Route::get('/dashboard', [ShopController::class, 'index'])->name('shop.index');
Route::get('/products', [ShopController::class, 'products'])->name('productall');
Route::get('/category/{id}', [ShopController::class, 'detail'])->name('detail');
Route::get('/show/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
Route::get('/cart', [ShopController::class, 'cart'])->name('shop.cart');
Route::get('/addToCart/{id}', [ShopController::class, 'addtocart'])->name('shop.addToCart');
Route::get('/remove-cart/{id}', [ShopController::class, 'removeCart'])->name('shop.remove11');
Route::get('/login', [ShopController::class, 'login'])->name('shop.login');
Route::post('/checklogin', [ShopController::class, 'checklogin'])->name('shop.checklogin');
Route::get('/register', [ShopController::class, 'register'])->name('shop.register');
Route::post('/checkregister', [ShopController::class, 'checkregister'])->name('shop.checkregister');
Route::post('/logout', [ShopController::class, 'logout'])->name('shop.logout');
Route::post('/order', [ShopController::class, 'order'])->name('shop.order');
});
