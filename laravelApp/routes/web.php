<?php
use App\Http\Resources\managerResource;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\Test;
use App\Models\manager;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/check-connection', function () {
    try {
        DB::connection()->getPdo();
        echo "Connection successful.";
    } catch (\Exception $e) {
        die("Connection failed: " . $e->getMessage());
    }
});

Route::get('managers', [
    ManagerController::class,
    'index'
]);
Route::get('/managers/{_id}', [
    ManagerController::class, 
    'show'
]);
Route::post('managers', [
    ManagerController::class,
    'store'
]);
Route::delete('/managers/{manager}', [ManagerController::class, 'destroy']);
Route::put('/managers/{manager}', [ManagerController::class, 'update']);
Route::resource('ManagerController', ManagerController::class);