<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');


Route::get('/register',[RegisterController::class,'show'])->name('register');
Route::post('/register',[RegisterController::class,'store']);
Route::get('/login',[LoginController::class,'show'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',LogoutController::class)->name('logout');