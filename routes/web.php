<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

Route::get('/', function () { return view('welcome'); });

// auth transactions
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post'); // registration operation for both seller and customer
Route::get('/register/seller', [AuthController::class, 'sellerRegister'])->name('register.seller');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// user CRUD transactions
Route::middleware('auth')->prefix('users')->group(function() {
    Route::get('/index', [UsersController::class, 'index'])->name('users.index');
    Route::post('/create', [UsersController::class, 'store'])->name('users.create');
    Route::put('/update/{userId}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('{userId}/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/profile',  [UsersController::class, 'profile'])->name('profile'); // view profile
});

// food CRUD transactions
Route::middleware('auth')->prefix('foods')->group(function() {
    Route::get('/index', [FoodController::class, 'index'])->name('foods.index');
    Route::post('/create', [FoodController::class, 'store'])->name('foods.create');
    Route::put('/update/{foodId}', [FoodController::class, 'update'])->name('foods.update');
    Route::delete('{userId}/destroy', [FoodController::class, 'destroy'])->name('foods.destroy');
});

// order transactions
Route::middleware('auth')->prefix('orders')->group(function() {
    Route::post('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/completed', [OrderController::class, 'completedOrders'])->name('orders.completed');
    Route::get('/ongoing', [OrderController::class, 'ongoingOrders'])->name('orders.ongoing');
    Route::put('/update/{orderId}', [OrderController::class, 'updateStatus'])->name('orders.update');
});

Route::middleware('auth')->get('/admin/index', [DashBoardController::class, 'index'])->name('admin.index');
