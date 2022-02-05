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

// user
use App\Controllers\User\UserMainController;
use App\Controllers\User\UserSettingController;

// admin
use App\Controllers\Admin\AdminController;

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
        Route::delete('/room/{id}', [OwnerRoomController::class, 'delete']);
    });



Route::middleware([AuthMiddleware::class])
    ->prefix('/user')
    ->group(function () {
        Route::get('/', [UserMainController::class, 'index']);
        Route::get('/transactions', [UserMainController::class, 'transaction']);
        Route::get('/setting', [UserSettingController::class, 'show']);
        Route::put('/setting', [UserSettingController::class, 'update']);
});




Route::middleware([AuthMiddleware::class])
    ->prefix('/admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/places', [AdminController::class, 'place']);
        Route::get('/rooms', [AdminController::class, 'room']);
        Route::get('/transactions', [AdminController::class, 'transaction']);
        Route::get('/transaction/{id}', [AdminController::class, 'detailTransaction']);
        Route::post('/transaction/{id}', [AdminController::class, 'processTransaction']);
});

