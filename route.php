<?php
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\SellerController;
use App\Middlewares\AuthMiddleware;
use Illuminate\Support\Facades\Route;

// owner
use App\Controllers\Owner\OwnerPlaceController;
use App\Controllers\Owner\OwnerRoomController;
use App\Controllers\RoomController;
use App\Controllers\PlaceController;
use App\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/rooms/{id}', [RoomController::class, 'detail']);
Route::get('/place/{id}', [PlaceController::class, 'detail']);

Route::middleware([AuthMiddleware::class])
    ->group(function () {
        Route::post('/checkout', [CheckoutController::class, 'checkout']);
        Route::post('/checkout/payment', [CheckoutController::class, 'payment']);
        Route::get('/checkout/payment/{id}', [CheckoutController::class, 'tryPayment']);
        Route::post('/checkout/payment/{id}', [CheckoutController::class, 'postPayment']);
    });

Route::middleware([AuthMiddleware::class])
    ->prefix('/seller')
    ->group(function () {
        Route::get('/', [SellerController::class, 'index']);
        Route::get('/place', [OwnerPlaceController::class, 'index']);
        Route::post('/place', [OwnerPlaceController::class, 'createOrUpdate']);
        
        Route::get('/room', [OwnerRoomController::class, 'index']);
        Route::get('/room/create', [OwnerRoomController::class, 'create']);
        Route::post('/room', [OwnerRoomController::class, 'store']);
        Route::get('/room/{id}', [OwnerRoomController::class, 'detail']);
        Route::put('/room/{id}', [OwnerRoomController::class, 'update']);
        Route::get('/delete/{id}', [OwnerRoomController::class, 'delete']);
    });

