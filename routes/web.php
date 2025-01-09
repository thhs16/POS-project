<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;

Route::redirect('/','auth/login');

Route::get('login/register', [AuthController::class, 'registerPage'])->name('userRegister');

Route::get('auth/login', [AuthController::class, 'loginPage'])->name('userLogin');


Route::get('/auth/{provider}/redirect', [ProviderController::class,'redirect']);

Route::get('/auth/{provider}/callback', [ProviderController::class,'callback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// admin
Route::group([ 'prefix' => 'admin', 'middleware' => 'admin'], function(){

    Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('adminDashboard');

});

// customer
Route::group([ 'prefix' => 'customer', 'middleware' => 'user'], function(){

    Route::get('/home', [UserDashboardController::class, 'index'])->name('customerDashboard');

});
