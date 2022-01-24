<?php
use App\Controllers\HomeController;
use App\Controllers\AuthController;
// use App\Middlewares\Auth;

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);


