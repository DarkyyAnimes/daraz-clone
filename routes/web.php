<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Seller\SellerViewController;
use App\Http\Controllers\Seller\SellerAuthController;
use App\Http\Controllers\Seller\SellerFunctionalityController;

use App\Http\Controllers\User\UserViewController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserFunctionalityController;


use App\Http\Controllers\Admin\AdminViewController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminFunctionalityController;
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

// User Routes
Route::get('/' , [UserViewController::class, 'index']);
Route::get('/product/{id}', [UserViewController::class, 'product'])->name('product');
Route::get('/category/{id}', [UserViewController::class, 'category'])->name('category');
Route::get('/store/{id}', [UserViewController::class, 'store'])->name('store');


Route::middleware(['auth', 'user.unverfified'])->group(function () {    
    Route::get('/verify-email', [UserViewController::class, 'email_verify_interface'])->name('verify.email.interface');
    Route::get('/resend-verify-email', [UserViewController::class, 'resend_email_verify'])->name('resend.verify.email.interface');
    Route::post('/verify-email', [UserFunctionalityController::class, 'email_verify'])->name('verify.email');
    Route::post('/resend-verify-email', [UserFunctionalityController::class, 'resend_email_verify'])->name('resend.verify.email');
});


Route::get('/verify', [UserFunctionalityController::class, 'email_verified'])->name('verify.email.functional');

Route::middleware(['auth', 'user.verified'])->group(function () {
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
    Route::get('/add-to-cart/{id}', [UserFunctionalityController::class, 'add_to_cart'])->name('add.to.cart');
    Route::get('/remove-from-cart/{id}', [UserFunctionalityController::class, 'remove_from_cart'])->name('remove.from.cart');
    Route::get('/carts', [UserViewController::class, 'cart'])->name('user.carts');
    Route::get('/carts/checkout/{id}', [UserFunctionalityController::class, 'cart_checkout'])->name('checkout.from.cart');
    Route::get('/order/products', [UserViewController::class, 'order_products'])->name('order.products');    
    Route::get('/esewa/success', [UserFunctionalityController::class, 'esewa_success'])->name('esewa.payment.success');
    Route::post('/esewa/failure', [UserFunctionalityController::class, 'pay_by_esewa'])->name('esewa.payment.fail');
    Route::get('/product/done/{id}', [UserFunctionalityController::class, 'product_received'])->name('order.done');
    Route::get('/procced', [UserFunctionalityController::class ,'checkout'])->name('procced.to.checkout');
});


// Guest Routes 

Route::middleware(['guest:seller', 'guest:admin', 'guest'])->group(function () {    
    Route::get('/login', [UserViewController::class, 'login'])->name('login')->middleware(['guest', 'guest:seller']);
    Route::get('/register', [UserViewController::class, 'register'])->name('view.user.register')->middleware(['guest','guest:seller']);
    Route::post('seller/register', [SellerAuthController::class, 'register'])->name('seller.register');
    Route::post('seller/login', [SellerAuthController::class, 'login'])->name('seller.login');
    
    Route::post('/register', [UserAuthController::class, 'register'])->name('user.register');
    Route::post('/login', [UserAuthController::class, 'login'])->name('user.login');
    
    Route::get('seller/register', [SellerViewController::class, 'register'])->name('view.seller.register');
    Route::get('seller/login', [SellerViewController::class, 'login'])->name('view.seller.login');
    Route::get('/ecom-admin/login', [AdminViewController::class, 'login']);  
    Route::post('/ecom-admin/login', [AdminAuthController::class, 'login'])->name('admin.login');  
});





// Admin Routes
// Seller Routes

Route::get('/search', [SellerFunctionalityController::class, 'search'])->name('category.search');

Route::middleware(['auth:seller'])->prefix('seller')->group(function(){
    Route::get('/', [SellerViewController::class, 'dashboard'])->name('view.seller');
    Route::get('/pending-orders', [SellerViewController::class, 'pending_orders'])->name('view.seller.pending');
    Route::get('/complete-orders', [SellerViewController::class, 'complete_orders'])->name('view.seller.complete');
    Route::get('/pending-orders/{id}', [SellerFunctionalityController::class, 'pending_orders_done'])->name('view.seller.pending.done');
    Route::get('/dashboard',[SellerViewController::class, 'dashboard'])->name('view.seller.dashboard');
    Route::get('/products', [SellerViewController::class , 'allproducts'])->name('view.seller.allproducts');
    Route::get('/add-product', [SellerViewController::class , 'addproduct'])->name('view.seller.addproduct');
    Route::get('/edit-product/{id}', [SellerViewController::class , 'edit'])->name('view.edit.product');
    Route::post('/edit-product/{id}', [SellerFunctionalityController::class , 'edit'])->name('functions.seller.updateproduct');
    Route::post('/add-product', [SellerFunctionalityController::class , 'addproduct'])->name('functions.seller.addproduct');
    Route::get('/delete-product/{id}', [SellerFunctionalityController::class , 'delete'])->name('delete.product');
    Route::get('/profile', [SellerViewController::class , 'profile'] )->name('view.seller.profile');
    Route::get('/logout', [SellerAuthController::class , 'logout'] )->name('view.seller.logout');
});




Route::middleware(['auth:admin'])->prefix('ecom-admin')->group(function () {
    Route::get('dashboard', [AdminViewController::class, 'index'])->name('admin.dashboard');

    Route::get('seller/see/{id}', [AdminViewController::class, 'index'])->name('admin.seller.see');
    Route::get('seller/delete/{id}', [AdminFunctionalityController::class, 'deleteuser'])->name('admin.delete.user');

    Route::get('category', [AdminViewController::class, 'category'])->name('admin.view.category');

    Route::get('add-category', [AdminViewController::class, 'addcategory'])->name('admin.add.category');
    Route::post('add-category', [AdminFunctionalityController::class, 'addcategory'])->name('admin.post.add.category');

    Route::get('edit-category/{id}', [AdminViewController::class, 'editcategory'])->name('admin.edit.category');

    Route::post('edit-category/{id}', [AdminFunctionalityController::class, 'edit_category'])->name('admin.post.edit.category');

    Route::get('delete-category/{id}', [AdminFunctionalityController::class, 'deletecategory'])->name('admin.delete.category');
    Route::get('delete-seller/{id}', [AdminFunctionalityController::class, 'deleteseller'])->name('admin.delete.seller');

    Route::get('/users', [AdminViewController::class, 'users'])->name('admin.users');

    Route::get('add-slider', [AdminViewController::class, 'addslider'])->name('admin.add.slider');
    Route::post('add-slider', [AdminFunctionalityController::class, 'slider_image'])->name('admin.add.post.slider');

    Route::get('logout', [AdminViewController::class, 'logout'])->name('admin.logout');
});