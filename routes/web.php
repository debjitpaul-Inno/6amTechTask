<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('product', ProductController::class);
Route::get('/product-filter', [ProductController::class, 'productFilter'])->name('product.filter');
//Route::get('insert-update', [ProductController::class, 'insertUpdateView'])->name('product.insertUpdateView');
//Route::post('insert-update', [ProductController::class, 'insertUpdate'])->name('product.insertUpdate');
