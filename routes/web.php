<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;


Route::get('/', function () { return view('welcome'); });

Route::get('/profile', function () { return view('profile'); })->name('profile');
Route::get('/admin/index', [DashBoardController::class, 'index'])->name('admin.index');

Route::get('/login', function(){ return view('auth.login'); })->name('login');
Route::get('/register', function(){ return view('auth.register'); })->name('register');
Route::get('/sellerRegister', function(){ return view('auth.sellerRegister'); })->name('sellerRegister');


// user CRUD transactions
Route::prefix('users')->group(function() {
    Route::get('/index', [UsersController::class, 'index'])->name('users.index');
    Route::post('/create', [UsersController::class, 'store'])->name('users.create');
    Route::put('/update/{userId}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('{userId}/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
});

// food CRUD transactions
Route::prefix('foods')->group(function() {
    Route::get('/index', [FoodController::class, 'index'])->name('foods.index');
    Route::post('/create', [FoodController::class, 'store'])->name('foods.create');
    Route::put('/update/{foodId}', [FoodController::class, 'update'])->name('foods.update');
    Route::delete('{userId}/destroy', [FoodController::class, 'destroy'])->name('foods.destroy');
});

// order transactions
Route::prefix('orders')->group(function() {
    Route::post('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/completed', [OrderController::class, 'completedOrders'])->name('orders.completed');
    Route::get('/ongoing', [OrderController::class, 'ongoingOrders'])->name('orders.ongoing');
    Route::put('/update/{orderId}', [OrderController::class, 'updateStatus'])->name('orders.update');
});
