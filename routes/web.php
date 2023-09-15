<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () { return view('index'); })->name('index');
Route::get('/orders', function () { return view('orders'); })->name('orders');
Route::get('/completed_orders', function () { return view('completed_orders'); })->name('completedOrders');
Route::get('/profile', function () { return view('profile'); })->name('profile');
//Route::get('/admin/users', function () { return view('admin.users'); })->name('admin.users');
Route::get('/admin/index', function () { return view('admin.index'); })->name('admin.index');

Route::get('/login', function(){ return view('auth.login'); })->name('login');
Route::get('/register', function(){ return view('auth.register'); })->name('register');
Route::get('/sellerRegister', function(){ return view('auth.sellerRegister'); })->name('sellerRegister');

Route::resource('users', UserController::class);