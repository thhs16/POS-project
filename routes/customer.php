<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserDashboardController;



// customer
Route::group([ 'prefix' => 'customer', 'middleware' => ['user', 'auth']], function(){

    Route::get('/home', [UserDashboardController::class, 'index'])->name('customerDashboard');

    // ? means you can assign the variable or not
    Route::get('/shop/{category_id?}', [UserDashboardController::class, 'shop'])->name('customerShop');
//    shop/Detail try to be concerned with the above route
    Route::get('/shopDetail/{product_id}', [UserDashboardController::class, 'shopDetail'])->name('shopDetail');
    Route::get('/createComment', [UserDashboardController::class, 'createComment'])->name('createComment');
    Route::post('/productRating', [UserDashboardController::class, 'productRating'])->name('productRating');
    Route::get('/cart', [UserDashboardController::class, 'cart'])->name('cart');
    Route::get('/addToCart', [UserDashboardController::class, 'addToCart'])->name('addToCart');
    Route::get('/removeCart', [UserDashboardController::class, 'removeCart'])->name('removeCart');
    Route::get('/order', [UserDashboardController::class, 'order'])->name('order');


});
