<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::middleware(['auth:manager'])->group(function () {
    Route::get('/authen/admin/getme', [AuthController::class, 'meManager']);

    Route::get('/managers', [ManagerController::class, "index"]);
    Route::post('/managers', [ManagerController::class, "store"]);

    Route::get('/order', [OrderController::class, 'index']);
    Route::put('/order/{order}', [OrderController::class, 'update']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);

    Route::get('/routes/{_id}', [RouteController::class, "show"]);
    Route::post('/routes', [RouteController::class, "store"]);
    Route::delete('/routes/{_id}', [RouteController::class, "destroy"]);
    Route::put('/routes/{_id}', [RouteController::class, "update"]);

    Route::get('/bases/{_id}', [BaseController::class, "show"]);
    Route::post('/bases', [BaseController::class, "store"]);
    Route::delete('/bases/{_id}', [BaseController::class, "destroy"]);
    Route::put('/bases/{_id}', [BaseController::class, "update"]);

    Route::get('/buses/{_id}', [BusController::class, "show"]);
    Route::post('/buses', [BusController::class, "store"]);
    Route::delete('/buses/{_id}', [BusController::class, "destroy"]);
    Route::put('/buses/{_id}', [BusController::class, "update"]);
});

Route::middleware(['auth:user'])->group(function () {
    Route::put('/users/{users}', [UserController::class, 'update']);
    Route::get('/authen/getme', [AuthController::class, 'me']);
});

Route::middleware(['auth:user', 'auth:manager'])->group(function () {
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/order/{id}', [OrderController::class, 'show']);
});

Route::get('/buses', [BusController::class, "index"]);

Route::get('/bases', [BaseController::class, "index"]);

Route::get('/routes', [RouteController::class, "index"]);

// Đăng ký
Route::post('/users', [UserController::class, 'store']);
// //API route để đăng nhập
Route::post('/authen', [AuthController::class, 'login']);
Route::post('/authen/admin', [AuthController::class, 'loginManager']);