<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProductCategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Product routes
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show'); 

// Category routes
Route::get('/categories', [ProductCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [ProductCategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/products', [ProductCategoryController::class, 'products'])->name('categories.products');


// Checkout routes
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'initiateCheckout'])->name('checkout.initiate');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'showConfirmation'])->name('checkout.confirmation');
});


// Order history routes
Route::get('/orders', [OrderHistoryController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderHistoryController::class, 'show'])->name('orders.show');
Route::post('/orders/{id}/cancel', [OrderHistoryController::class, 'cancel'])->name('orders.cancel');


// Cart route
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add'); // New route
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // New route
});


// New comparison routes
Route::post('/product/{category}/{product}/compare', [ProductController::class, 'addToCompare'])->name('products.addToCompare');
Route::get('/products/compare', [ProductController::class, 'compare'])->name('products.compare');
Route::delete('/product/{category}/{product}/compare', [ProductController::class, 'removeFromCompare'])->name('products.removeFromCompare');
Route::delete('/products/compare/clear', [ProductController::class, 'clearCompare'])->name('products.clearCompare');


// Pages
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');

Route::middleware(['auth'])->group(function () {
});
Route::middleware(['auth'])->prefix('buyer/dashboard')->name('buyer.dashboard.')->group(function () {
    Route::get('/', [App\Http\Controllers\BuyerDashboardController::class, 'index'])->name('index');
    Route::get('/orders', [App\Http\Controllers\BuyerDashboardController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [App\Http\Controllers\BuyerDashboardController::class, 'showOrder'])->name('orders.show');
        Route::get('/addresses', [App\Http\Controllers\BuyerDashboardController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [App\Http\Controllers\BuyerDashboardController::class, 'storeAddress'])->name('addresses.store');
    Route::get('/addresses/{address}/edit', [App\Http\Controllers\BuyerDashboardController::class, 'editAddress'])->name('addresses.edit');
    Route::put('/addresses/{address}', [App\Http\Controllers\BuyerDashboardController::class, 'updateAddress'])->name('addresses.update');
    Route::delete('/addresses/{address}', [App\Http\Controllers\BuyerDashboardController::class, 'deleteAddress'])->name('addresses.destroy');
    Route::get('/account-settings', [App\Http\Controllers\BuyerDashboardController::class, 'accountSettings'])->name('account-settings');
    Route::post('/account-settings', [App\Http\Controllers\BuyerDashboardController::class, 'updateAccountSettings'])->name('account-settings.update');
});
