<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('dashboard');

Route::middleware('guest')->group(function(){
    Route::get('/register',[RegisterController::class,'show'])->name('register');
    Route::post('/register',[RegisterController::class,'store']);
    Route::get('/login',[LoginController::class,'show'])->name('login');
    Route::post('/login',[LoginController::class,'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout',LogoutController::class)->name('logout');
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('tasks',TaskController::class);
    Route::resource('categories',CategoryController::class)->except(['show']);
});

