<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AboutControllerAdmin;
use App\Http\Controllers\PurchaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [UserController::class, 'index1'])->name('index.view');
Route::get('/product/{id}', [ProductController::class, 'showdetails'])->name('product.show');
Route::get('/admin/product/{id}', [ProductController::class, 'admindetails'])->name('admin.product.show');

Route::get('/Registration', [UserController::class, 'index'])->name('user.registration');
Route::post('/Registration', [UserController::class, 'register'])->name('user.register');
Route::get('login', [UserController::class, 'showLoginForm'])->name('login.log');
Route::post('login', [UserController::class, 'login'])->name('log.send');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//about
// Route::get('about', [AboutControllerAdmin::class, 'indexview'])->name('front');
Route::get('/about',[AboutControllerAdmin::class,'frontview'])->name('about');

// web.php
// Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
// // Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
// Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
// Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
// Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

Route::get('/order/confirmation/{order}', [CheckoutController::class, 'orderConfirmation'])->name('order.confirmation');




// Cart routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');


Route::middleware(['user'])->group(function () {

    // Route::get('/admin/accounts', [UserController::class, 'accountview'])->name('admin.accounts.index');
    Route::get('/account', [UserController::class, 'accountview'])->name('admin.accounts.index');

    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    //Invoice
    Route::get('/order/{id}/invoice', [CheckoutController::class, 'generateInvoice'])->name('order.invoice');

    Route::post('/user/update', [UserController::class, 'userupdate'])->name('user.update');
    Route::get('/user/update', [UserController::class, 'updateview'])->name('user.update.view');


    //test

   
Route::get('/checkout/print/{id}',  [CheckoutController::class,'printOrder'])->name('checkout.print');
    
});

// Admin dashboard - Protected by auth middleware


Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminHomeController::class, 'index'])->name('admin');
    Route::get('/create_product', [ProductController::class, 'index'])->name('add.product');
    Route::get('/productadd', [ProductController::class, 'index'])->name('product.add');
    Route::post('/addproduct', [ProductController::class, 'store'])->name('products.store');
    Route::get('/p_listing', [ProductController::class, 'productmanage'])->name('product.manage');
    Route::post('/manageproduct', [ProductController::class, 'manageproduct'])->name('manage.product');
    Route::get('/brandadd', [ProductController::class, 'brandview'])->name('brand.add');
    Route::get('/brandlist', [ProductController::class, 'brandlist'])->name('brand.list');
    Route::get('/brandedit/{id}', [ProductController::class, 'brandedit'])->name('brand.edit');
    Route::delete('/brand/{id}', [ProductController::class, 'destroybrand'])->name('brand.destroy');
    Route::put('/brandd/update/{id}', [ProductController::class, 'brandupdate'])->name('update.brand');
    Route::post('/addbrand', [ProductController::class, 'brandadd'])->name('add.brand');
    Route::get('/sizelist', [ProductController::class, 'sizelist'])->name('size.list');
    Route::get('/sizeadd', [ProductController::class, 'sizeview'])->name('size.add');
    Route::post('/addsize', [ProductController::class, 'sizeadd'])->name('add.size');
    Route::get('/size/{id}', [ProductController::class, 'sizeedit'])->name('size.edit');
    Route::delete('/size/{id}', [ProductController::class, 'destroysize'])->name('size.destroy');
    Route::put('/size/update/{id}', [ProductController::class, 'sizeupdate'])->name('update.size');
    Route::get('/colorlist', [ProductController::class, 'colorlist'])->name('color.list');
    Route::get('/coloradd', [ProductController::class, 'colorview'])->name('color.add');
    Route::post('/addcolor', [ProductController::class, 'coloradd'])->name('add.color');
    Route::get('/color/{id}', [ProductController::class, 'coloredit'])->name('color.edit');
    Route::delete('/color/{id}', [ProductController::class, 'destroycolor'])->name('color.destroy');
    Route::put('/color/update/{id}', [ProductController::class, 'colorupdate'])->name('update.color');
    Route::get('/unitlist', [ProductController::class, 'unitlist'])->name('unit.list');
    Route::get('/unitadd', [ProductController::class, 'unitview'])->name('unit.add');
    Route::post('/addunit', [ProductController::class, 'unitadd'])->name('add.unit');
    Route::get('/unit/{id}', [ProductController::class, 'unitedit'])->name('unit.edit');
    Route::delete('/unit/{id}', [ProductController::class, 'destroyunit'])->name('unit.destroy');
    Route::put('/unit/update/{id}', [ProductController::class, 'unitupdate'])->name('update.unit');
    Route::get('/categorylist', [ProductController::class, 'categorylist'])->name('category.list');
    Route::get('/categoryadd', [ProductController::class, 'categoryview'])->name('category.add');
    Route::get('/categoryedit/{id}', [ProductController::class, 'categoryedit'])->name('category.edit');
    Route::put('/category/update/{id}', [ProductController::class, 'categoryupdate'])->name('update.category');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('add.category');
    Route::delete('/category/{id}', [ProductController::class, 'categorydestroy'])->name('category.destroy');
    Route::get('/products', [ProductController::class, 'viewlist'])->name('products.viewlist');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/orders', [CheckoutController::class, 'index'])->name('orders.index');

    Route::post('/admin/orders/update-status/{id}', [CheckoutController::class, 'updateStatus'])->name('admin.orders.update-status');



    //slider

    Route::get('admin/slider', [AdminHomeController::class, 'indexslider'])->name('admin.slider.index');
    Route::get('admin/slider/create', [AdminHomeController::class, 'createslider'])->name('admin.slider.create');
    Route::post('admin/slider', [AdminHomeController::class, 'storeslider'])->name('admin.slider.store');


    //about

    Route::get('/about/info', [AboutControllerAdmin::class, 'index'])->name('about.index');
    Route::post('/about/update', [AboutControllerAdmin::class, 'update']);

Route::get('/admin/company-info/edit', [AboutControllerAdmin::class, 'edit'])->name('company-info.edit');
Route::post('/admin/company-info/edit', [AboutControllerAdmin::class, 'update'])->name('company-info.update');



Route::get('/purchase',[PurchaseController::class, 'index'])->name('purchase.store');
Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store.post');
Route::get('/purchase-products', [PurchaseController::class, 'listview'])->name('purchase-products.index');


});


// Admin Login Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');