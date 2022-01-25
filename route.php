<?php
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\SellerController;
use App\Middlewares\AuthMiddleware;
use Illuminate\Support\Facades\Route;

// owner
use App\Controllers\Owner\PlaceOwnerController;
use App\Controllers\Owner\RoomControler;

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware([AuthMiddleware::class])
    ->prefix('/seller')
    ->group(function () {
        Route::get('/', [SellerController::class, 'index']);
        Route::get('/place', [PlaceOwnerController::class, 'index']);
        Route::post('/place', [PlaceOwnerController::class, 'createOrUpdate']);
        
        Route::get('/room', [RoomControler::class, 'index']);
        Route::get('/room/create', [RoomControler::class, 'create']);
        Route::post('/room', [RoomControler::class, 'store']);
        Route::get('/room/{id}', [RoomControler::class, 'detail']);
        Route::put('/room/{id}', [RoomControler::class, 'update']);
        Route::get('/delete/{id}', [RoomControler::class, 'delete']);
    });

