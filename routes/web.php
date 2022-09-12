<?php

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

Route::get('/detail', function () {
    return view('frontend.detail');
});

Route::get('product-list', function () {
    return view('frontend.product-list');
});

// Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
// Route::post('/login', [\App\Http\Controllers\AuthController::class, 'postLogin'])->name('login');
// Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// ADMIN
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);
    Route::resource('product', \App\Http\Controllers\Backend\ProductController::class);
    Route::resource('user', \App\Http\Controllers\Backend\UserController::class);
    Route::resource('promotion', \App\Http\Controllers\Backend\PromotionController::class);
    Route::post('/product/categories-child/{id}', [\App\Http\Controllers\Backend\ProductController::class,'getChildCategories']);
    Route::patch('/product-image/{id}/update', [\App\Http\Controllers\Backend\ProductController::class,'updateProductImage']);
});

Auth::routes();

// USER
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/{product}', [App\Http\Controllers\ProductDetailController::class, 'index'])->name('product.detail');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/{product}', [App\Http\Controllers\CartController::class, 'updateQty'])->name('cart.update');
Route::delete('/cart-remove/{product}', [App\Http\Controllers\CartController::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/count-total', [App\Http\Controllers\CartController::class, 'countTotal'])->name('cart.total');
Route::middleware('auth')->group(function() {
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/order', [App\Http\Controllers\CheckoutController::class, 'store'])->name('order.store');
    Route::post('/cities', [App\Http\Controllers\CheckoutController::class, 'getCity'])->name('city');
    Route::post('/shipping-cost', [App\Http\Controllers\CheckoutController::class, 'shippingCost'])->name('shipping.cost');
    Route::post('/total-cost', [App\Http\Controllers\CheckoutController::class, 'totalCost'])->name('total.cost');
    Route::post('/product/{product}/review', [App\Http\Controllers\ProductDetailController::class, 'addReview'])->name('product.review');
});