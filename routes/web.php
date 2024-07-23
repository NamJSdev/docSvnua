<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

Route::get('/danh-muc/form-khoi-tao', [CategoryController::class, 'create'])->name('categories.create')->middleware('admin');
Route::get('/danh-muc/danh-sach-danh-muc', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
Route::post('/danh-muc/sua-danh-muc', [CategoryController::class, 'update'])->name('categories.update')->middleware('admin');
Route::post('/danh-muc/xoa-danh-muc', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('admin');
Route::post('/danh-muc', [CategoryController::class, 'store'])->name('categories.store')->middleware('admin');

Route::get('/post-admin', [PostController::class, 'index'])->name('posts.index')->middleware('admin');
Route::get('/post-pending', [PostController::class, 'active'])->name('posts.active')->middleware('admin');
Route::get('/post-doc', [PostController::class, 'doc'])->name('posts.doc')->middleware('admin');
Route::post('/post-approved', [PostController::class, 'approved'])->name('posts.approved')->middleware('admin');
Route::post('/post-rejected', [PostController::class, 'rejected'])->name('posts.rejected')->middleware('admin');
Route::post('/post-delete', [PostController::class, 'delete'])->name('posts.delete')->middleware('admin');

//Client Routes
Route::get('/', [PageController::class, 'home'])->name('home-page');
Route::get('/login-user', [AuthController::class, 'showLoginFormUser'])->name('login-user.form');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout-user', [AuthController::class, 'logoutUser'])->name('logout-user')->middleware('user');
Route::get('/upload', [PageController::class, 'uploadForm'])->name('upload.form')->middleware('user');

//Upload post
Route::post('/post-upload', [PostController::class, 'store'])->name('posts.store')->middleware('user');
Route::get('/post-client/{categoryID}', [PostController::class, 'postForCategory'])->name('post-client.category');
Route::get('/post-detail/{postID}', [PostController::class, 'postDetail'])->name('post-detail')->middleware('user');
Route::get('/search', [PostController::class, 'search'])->name('search');

//Account User
Route::get('/account-edit', [AccountController::class, 'accountEditForm'])->name('account-edit.form')->middleware('user');
Route::get('/account-user/{accountID}', [AccountController::class, 'accountUser'])->name('account-user')->middleware('user');
Route::post('/account-update', [AccountController::class, 'accountUserUpdate'])->name('account-edit.update')->middleware('user');