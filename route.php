<?php
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\SellerController;
use App\Middlewares\AuthMiddleware;


// owner
use App\Controllers\Owner\PlaceOwnerController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::middleware([AuthMiddleware::class])
      ->prefix('/seller')
      ->group(function() {
          Route::get('/', [SellerController::class, 'index']);
          Route::get('/place', [PlaceOwnerController::class, 'index']);
          Route::post('/place', [PlaceOwnerController::class, 'createOrUpdate']);
      });