<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', [ProductController::class, 'index'])->middleware('userAuth');

Route::post('login', [UserController::class, 'login']);

Route::get('login', [UserController::class, 'showLoginPage']);

Route::get('logout', [UserController::class, 'logout']);

Route::get('product', [ProductController::class, 'product']);

Route::get('updateCart/{product_id}/{amount}', [ProductController::class, 'updateCart']);

Route::get('getProductInfo', [ProductController::class, 'getProductInfo']);