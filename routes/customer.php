<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserDashboardController;



// customer
Route::group([ 'prefix' => 'customer', 'middleware' => ['user', 'auth']], function(){

    Route::get('/home', [UserDashboardController::class, 'index'])->name('customerDashboard');

    // ? means you can assign the variable or not
    Route::get('/shop/{category_id?}', [UserDashboardController::class, 'shop'])->name('customerShop');

});
