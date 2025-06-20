<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {return view('welcome');})->name(('login'));

// Admin Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin-main')->middleware('auth:admin');
Route::get('/admin-login', [AdminController::class, 'login_page'])->name('admin.login');
Route::post('/admin-login', [AdminController::class, 'login_action'])->name('admin.login.action');
// Admin CRUD Routes
Route::get('/admin-create', [AdminController::class, 'create_data_page'])->name('admin.create')->middleware('auth:admin');
Route::post('/admin-create', [AdminController::class, 'create_data_action'])->name('admin.create.data')->middleware('auth:admin');

// User Routes
Route::get('/user', [UserController::class, 'index'])->name('user-main')->middleware('user.auth');
Route::get('/user-login', [UserController::class, 'login_page'])->name('user.login');
Route::post('/user-login', [UserController::class, 'login_action'])->name('user.login.action');
// User CRUD Routes
// Route::get('/admin-create', [AdminController::class, 'create_data_page'])->name('admin.create')->middleware('auth:admin');
// Route::post('/admin-create', [AdminController::class, 'create_data_action'])->name('admin.create.data')->middleware('auth:admin');

Route::post('/user-logout', [UserController::class, 'logout'])->name('user.logout');
Route::post('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');