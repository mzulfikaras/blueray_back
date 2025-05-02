<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RoleController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/roles', [RoleController::class,'index']);

    Route::get('/user', [UserController::class, 'userView']);
    Route::get('/user/list', [UserController::class, 'index']);
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'edit']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    Route::get('/courier', [OrderController::class, 'indexCourier']);
    Route::get('/maps', [OrderController::class, 'indexMaps']);

    Route::get('/order', [OrderController::class, 'indexOrderAdmin']);
    Route::get('/order/{id}', [OrderController::class, 'indexOrderUser']);
    Route::post('/order', [OrderController::class, 'createOrder']);
    Route::get('/order/tracking/{trackingId}', [OrderController::class, 'trackingOrder']);
});
