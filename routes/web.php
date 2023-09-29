<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () { return view('welcome'); });

// auth transactions
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post'); // registration operation for both seller and customer
Route::get('/register/seller', [AuthController::class, 'sellerRegister'])->name('register.seller');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//view admin panel
Route::middleware(['auth', 'user-role:admin'])->get('/admin/index', [DashBoardController::class, 'index'])->name('admin.index');

//view profile
Route::middleware('auth')->get('/profile',  [UsersController::class, 'profile'])->name('profile');

// user CRUD transactions
Route::middleware(['auth', 'user-role:admin'])->prefix('users')->group(function() {
    Route::get('/index', [UsersController::class, 'index'])->name('users.index');
    Route::post('/create', [UsersController::class, 'store'])->name('users.create');
    Route::delete('{userId}/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
});
Route::middleware('auth')->put('/update/{userId}', [UsersController::class, 'update'])->name('users.update'); //user update

// food CRUD transactions
Route::middleware('auth')->prefix('foods')->group(function() {
    Route::get('/index', [FoodController::class, 'index'])->name('foods.index');
    Route::get('/create', [FoodController::class, 'create'])->name('foods.create');
    Route::post('/store', [FoodController::class, 'store'])->name('foods.store');
    Route::put('/update/{foodId}', [FoodController::class, 'update'])->name('foods.update');
    Route::delete('{userId}/destroy', [FoodController::class, 'destroy'])->name('foods.destroy');
});

// category CRUD transactions
Route::middleware('auth')->prefix('categories')->group(function() {
    Route::post('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [FoodController::class, 'store'])->name('foods.store');
    Route::put('/update/{categoryId}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('{categoryId}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
});

// order transactions
Route::middleware('auth')->prefix('orders')->group(function() {
    Route::post('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/completed', [OrderController::class, 'completedOrders'])->name('orders.completed');
    Route::get('/ongoing', [OrderController::class, 'ongoingOrders'])->name('orders.ongoing');
    Route::put('/update/{orderId}', [OrderController::class, 'updateStatus'])->name('orders.update');
});

