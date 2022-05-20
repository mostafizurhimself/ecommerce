<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Customer Route
Route::middleware(['assign.guard:customers'])->prefix('customer')->group(function () {
    Route::post('/register', [LoginController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/refresh', [LoginController::class, 'refresh']);

    // Authenticated routes
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::post('/logout', [LoginController::class, 'logout']);

        // Profile routes
        Route::get('/profile', [ProfileController::class, 'profile']);
        Route::post('/profile', [ProfileController::class, 'updateProfile']);
        Route::post('/address', [ProfileController::class, 'updateAddress']);
        Route::post('/change-password', [ProfileController::class, 'changePassword']);
    });
});


Route::apiResource('orders', OrderController::class)->only('index', 'show', 'store', 'update');
Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel']);