<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;

// get / post push patch delete

require __DIR__.'/auth.php';
require_once __DIR__.'/admin.php';
require_once __DIR__.'/customer.php';

Route::redirect('/','auth/login');

Route::get('login/register', [AuthController::class, 'registerPage'])->name('userRegister');

Route::get('auth/login', [AuthController::class, 'loginPage'])->name('userLogin');


Route::get('/auth/{provider}/redirect', [ProviderController::class,'redirect']);

Route::get('/auth/{provider}/callback', [ProviderController::class,'callback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
