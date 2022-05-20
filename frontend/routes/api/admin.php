<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\UnitController;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\DeliveryController;
use App\Http\Controllers\Api\Admin\ResetPasswordController;
use App\Http\Controllers\Api\Admin\ForgotPasswordController;
use App\Http\Controllers\Api\Admin\NotificationController;

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

Route::group(['middleware' => ['assign.guard:users'], 'prefix' => 'admin'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/refresh', [LoginController::class, 'refresh']);
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('/profile', [ProfileController::class, 'profile']);
        Route::post('/profile', [ProfileController::class, 'updateProfile']);
        Route::post('/change-password', [ProfileController::class, 'changePassword']);
    });
});

Route::prefix('admin')->group(function () {
    // Resources
    Route::apiResourceFull('categories', CategoryController::class);
    Route::apiResourceFull('products', ProductController::class);
    Route::apiResourceFull('customers', CustomerController::class);
    Route::apiResource('orders', OrderController::class)->only('index', 'show');
    Route::post('orders/update-status', [OrderController::class, 'updateStatus']);
    Route::post('orders/mark-as-delivered', [OrderController::class, 'markAsDelivered']);
    Route::apiResource('deliveries', DeliveryController::class)->only('index', 'show');

    // Abstract routes
    Route::get('units', UnitController::class);

    // Admin notificaiton routes
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications', [NotificationController::class, 'markAllAsRead']);
    Route::delete('/notifications', [NotificationController::class, 'clearAll']);
});