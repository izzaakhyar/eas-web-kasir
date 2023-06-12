<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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

// Authenticate
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

// Registrasi
Route::get('/registration', [AuthController::class, 'daftar'])->name('register')->middleware(['guest']);
Route::post('/registration', [AuthController::class, 'registrasi'])->middleware(['guest']);

// CRUD Produk
Route::get('/list', [ProductController::class, 'index'])->name('showProduct')->middleware(['auth']);
Route::get('/create', [ProductController::class, 'add'])->name('create')->middleware(['auth', 'role: Admin']);
Route::post('/addproduct', [ProductController::class, 'create'])->middleware(['auth', 'role: Admin']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
Route::post('/product/{id}/update', [ProductController::class, 'update'])->middleware(['auth', 'role: Admin']);
Route::get('/product/{id}/delete', [ProductController::class, 'delete'])->middleware(['auth', 'role: Admin']);

// Cart
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth']);
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add')->middleware(['auth']);
Route::post('/cart/{productId}', [CartController::class, 'deleteProduct'])->middleware(['auth']);
Route::post('/checkout', [CartController::class, 'checkout'])->middleware(['auth']);

// Order History
Route::get('/history', [CartController::class, 'history'])->middleware(['auth']);

// Top Up
Route::get('/topup/{id}', [UserController::class, 'edit'])->middleware(['auth']);
Route::post('/topup-process/{id}', [UserController::class, 'update'])->middleware(['auth']);

// Game Library
Route::get('/library', [GameController::class, 'index'])->middleware(['auth']);

// Edit Profil
Route::get('/setting/{id}', [UserController::class, 'editProfil'])->middleware(['auth']);
Route::post('/user/{id}/update', [UserController::class, 'updateProfil'])->middleware(['auth']);
