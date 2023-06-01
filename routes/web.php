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

Route::get('/registration', [AuthController::class, 'daftar'])->name('register')->middleware(['guest']);
Route::post('/registration', [AuthController::class, 'registrasi'])->middleware(['guest']);

Route::get('/list', [ProductController::class, 'index'])->middleware(['auth']);
// Route::get('/create', [ProductController::class, 'add']);
// Route::get('/create', function () {
//     return view('create');
// });
Route::get('/create', [ProductController::class, 'add'])->middleware(['auth']);
Route::post('/addproduct', [ProductController::class, 'create'])->middleware(['auth']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->middleware(['auth']);
Route::post('/product/{id}/update', [ProductController::class, 'update'])->middleware(['auth']);
Route::get('/product/{id}/delete', [ProductController::class, 'delete'])->middleware(['auth']);

Route::get('/cart', [CartController::class, 'index'])->middleware(['auth']);
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add')->middleware(['auth']);

Route::post('/checkout', [CartController::class, 'checkout']);