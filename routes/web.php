<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/registration', [AuthController::class, 'daftar'])->name('register');
Route::post('/registration', [AuthController::class, 'registrasi']);

Route::get('/list', [ProductController::class, 'index'])->middleware(['auth']);
// Route::get('/create', [ProductController::class, 'add']);
// Route::get('/create', function () {
//     return view('create');
// });
Route::get('/create', [ProductController::class, 'add']);
Route::post('/addproduct', [ProductController::class, 'create']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
Route::post('/product/{id}/update', [ProductController::class, 'update']);
Route::get('/product/{id}/delete', [ProductController::class, 'delete']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');