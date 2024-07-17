<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

//Admin Routes
Route::get('/dashboard', [PageController::class, 'index'])->name('admin-dashboard')->middleware('auth');
//Show form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('admin');

//Lấy list tài khoản quản trị hệ thống
Route::get('/tai-khoan-he-thong', [AccountController::class, 'getAdminAccount'])->name('taikhoanhethong')->middleware('admin');
// Route cho việc tạo tài khoản hệ thống
Route::get('/tao-tai-khoan-he-thong', [AccountController::class, 'createAccountForm'])->name('create-account-form')->middleware('admin');
Route::post('/tao-tai-khoan', [AccountController::class, 'createAccount'])->name('create-account')->middleware('admin');
// Route cho việc cập nhật thông tin tài khoản hệ thống
Route::post('/sua-tai-khoan-he-thong', [AccountController::class, 'updateAccountAdmin'])->name('update-account-admin')->middleware('admin');
// Route cho việc cập nhật thông tin tài khoản nhân viên // Route cho việc tạo tài khoản hệ thống
Route::get('/tao-tai-khoan-he-thong', [AccountController::class, 'createAccountForm'])->name('create-account-form')->middleware('admin');
Route::post('/tao-tai-khoan', [AccountController::class, 'createAccount'])->name('create-account')->middleware('admin');
// Route cho việc cập nhật thông tin tài khoản hệ thống
Route::post('/sua-tai-khoan-he-thong', [AccountController::class, 'updateAccountAdmin'])->name('update-account-admin')->middleware('admin');
// Route cho việc xóa tài khoản hệ thống
Route::post('/xoa-tai-khoan-admin', [AccountController::class, 'deleteAccountAdmin'])->name('delete-account-admin')->middleware('admin');
//Client Routes