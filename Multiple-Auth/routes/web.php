<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {return view('welcome');})->name(('login'));

// Admin Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin-main')->middleware('auth:admin');
Route::get('/admin-login', [AdminController::class, 'login_page'])->name('admin.login');
Route::post('/admin-login', [AdminController::class, 'login_action'])->name('admin.login.action');

// User Routes
Route::get('/user', [UserController::class, 'index'])->name('user-main')->middleware('auth:web');
Route::get('/user-login', [UserController::class, 'login_page'])->name('user.login');
Route::post('/user-login', [UserController::class, 'login_action'])->name('user.login.action');

Route::post('/user-logout', [UserController::class, 'logout'])->name('user.logout');
Route::post('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');