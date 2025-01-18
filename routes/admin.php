<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
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
        Route::get('update',[CategoryController::class,'update'])->name('categoryUpdate');
    });

    // product
    Route::prefix('product')->group(function(){
        Route::get('list', [ProductController::class,'list'])->name('productList');
    });

});
