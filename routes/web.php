<?php

use App\Http\Controllers\AddUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
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

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');


Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::group(['middleware'=>'auth'], function(){

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/addproduct', [ProductController::class, 'create'])->name('product.add');
    Route::post('/addproduct', [ProductController::class, 'store']);
    Route::get('/addproduct/{product}/edit',  [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/addproduct/{product}',  [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('/product/category', [CategoryController::class, 'index'])->name('categories');
    Route::post('/product/category', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/product/category/{category}', [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('/product/size', [SizeController::class, 'index'])->name('sizes');
    Route::post('/product/size', [SizeController::class, 'store'])->name('size.store');
    Route::delete('/product/size/{size}', [SizeController::class, 'destroy'])->name('size.delete');

    Route::get('/product/color', [ColorController::class, 'index'])->name('colors');
    Route::post('/product/color', [ColorController::class, 'store'])->name('color.store');
    Route::delete('/product/color/{color}', [ColorController::class, 'destroy'])->name('color.delete');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('order.delete');

});


require __DIR__.'/auth.php';
