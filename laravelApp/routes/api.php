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
use App\Http\Controllers\ErrorController;


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

    Route::get('/orders', [OrderController::class, 'index']);
    Route::put('/orders/{order}', [OrderController::class, 'update']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);


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
   
});
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::get('/buses', [BusController::class, "index"]);

Route::get('/bases', [BaseController::class, "index"]);

Route::get('/routes', [RouteController::class, "index"]);
Route::get('/routes/{_id}', [RouteController::class, "show"]);

Route::post('/orders', [OrderController::class, 'store']);
// Đăng ký
Route::post('/users', [UserController::class, 'store']);
// //API route để đăng nhập
Route::post('/authen', [AuthController::class, 'login']);
Route::post('/authen/admin', [AuthController::class, 'loginManager']);

Route::get("/401", [ErrorController::class, 'error401']);