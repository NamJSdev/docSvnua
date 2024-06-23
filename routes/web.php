<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

//Admin Routes
Route::get('/dashboard', [PageController::class, 'index'])->name('admin-dashboard');


//Client Routes