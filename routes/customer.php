<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserDashboardController;



// customer
Route::group([ 'prefix' => 'customer', 'middleware' => ['user', 'auth']], function(){

    Route::get('/home', [UserDashboardController::class, 'index'])->name('customerDashboard');

});
