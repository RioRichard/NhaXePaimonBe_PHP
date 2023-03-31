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


Route::get('/managers', [ManagerController::class, "index"]);
Route::post('/managers', [ManagerController::class, "store"]);


//Bus api
Route::get('/buses', [BusController::class, "index"]);
Route::get('/buses/{_id}', [BusController::class, "show"]);
Route::post('/buses', [BusController::class, "store"]);
Route::delete('/buses/{_id}', [BusController::class, "destroy"]);
Route::put('/buses/{_id}', [BusController::class, "update"]);

//Base api
Route::get('/bases', [BaseController::class, "index"]);
Route::get('/bases/{_id}', [BaseController::class, "show"]);
Route::post('/bases', [BaseController::class, "store"]);
Route::delete('/bases/{_id}', [BaseController::class, "destroy"]);
Route::put('/bases/{_id}', [BaseController::class, "update"]);

//Route api
Route::get('/routes', [RouteController::class, "index"]);
Route::get('/routes/{_id}', [RouteController::class, "show"]);
Route::post('/routes', [RouteController::class, "store"]);
Route::delete('/routes/{_id}', [RouteController::class, "destroy"]);
Route::put('/routes/{_id}', [RouteController::class, "update"]);

//UsersAPI
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{users}', [UserController::class, 'update']);
Route::delete('/users/{users}', [UserController::class, 'destroy']);

//Order API
Route::get('/order', [OrderController::class, 'index']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::put('/order/{order}', [OrderController::class, 'update']);
Route::delete('/order/{order}', [OrderController::class, 'destroy']);
// //API route để đăng ký
Route::post('/authen', [AuthController::class, 'login']);
Route::get('/authen/getme', [AuthController::class, 'me']);
Route::post('/authen/manager', [AuthController::class, 'loginManager']);
Route::get('/authen/manager/getme', [AuthController::class, 'meManager']);


// Route::post('/authen/', [AuthController::class, 'me']);

// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('/profile', function(Request $request) { 
//         return auth()->user();
//     });
//     // API route thoát
//     Route::post('/logout', [AuthController::class, 'logout']);
// });