<?php

use App\Http\Controllers\OrderBoard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\adminUserlist;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;

// admin
Route::group([ 'prefix' => 'admin', 'middleware' => ['admin', 'auth']], function(){

    Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('adminDashboard');

    // category
    Route::prefix('category')->group(function(){
        Route::get('list', [CategoryController::class,'list'])->name('categoryList');
        Route::get('create', [CategoryController::class,'createPage'])->name('categoryCreatePage');
        Route::post('create', [CategoryController::class,'create'])->name('categoryCreate');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('categoryDelete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('categoryEdit');
        Route::post('update',[CategoryController::class,'update'])->name('categoryUpdate');
    });

    // product
    Route::prefix('product')->group(function(){
        Route::get('list', [ProductController::class,'list'])->name('productList');
        Route::get('create', [ProductController::class,'create'])->name('productcreate');
        Route::post('createCon', [ProductController::class,'CreateCon'])->name('productCreateCon');
        Route::get('delete/{id}', [ProductController::class,'productDelete'])->name('productDelete');
        Route::get('details/{id}', [ProductController::class,'productDetails'])->name('productDetails');
        Route::get('edit/{id}', [ProductController::class,'productEdit'])->name('productEdit');
        Route::post('update', [ProductController::class,'productUpdate'])->name('productUpdate');

    });

    // password
    Route::prefix('password')->group(function(){
        Route::get('changePg', [AuthController::class,'changePg'])->name('passwordChangePg');
        Route::post('change', [AuthController::class,'change'])->name('passwordChange');

    });

    // profile
    Route::prefix('profile')->group(function(){
        Route::get('details', [ProfileController::class,'profileDetails'])->name('profileDetails');
        Route::post('detailsUpdate', [ProfileController::class,'profileDetailsUpdate'])->name('profileDetailsUpdate');

        Route::get('create/adminAccPg', [ProfileController::class,'createAdminAccPg'])->name('createAdminAccPg');
        Route::post('create/adminAcc', [ProfileController::class,'createAdminAcc'])->name('createAdminAcc');
    });

    // role
    Route::get('admin&userlist', [adminUserlist::class,'adminUserList'])->name('admin&userlist');
    Route::get('userList', [adminUserlist::class,'userList'])->name('userList');
    Route::get('delete/{id}', [adminUserlist::class,'deleteAdmin'])->name('deleteAdmin');
    Route::get('deleteUser/{id}', [adminUserlist::class,'deleteUser'])->name('deleteUser');
    Route::get('changeToAdminRole/{id}', [adminUserlist::class,'changeToAdminRole'])->name('changeToAdminRole');

    // Order Board
    Route::prefix('orderBoard')->group(function(){
        Route::get('list', [OrderBoard::class,'list'])->name('orderBoardList');
        Route::get('orderCodeDetail/{orderCode}', [OrderBoard::class,'orderCodeDetail'])->name('orderCodeDetail');
        Route::get('statusChange', [OrderBoard::class,'statusChange'])->name('statusChange');
    });

    // admin and user accounts' profile
    Route::get('accountProfile/{id}', [adminUserlist::class,'accountProfile'])->name('accountProfile');
});
