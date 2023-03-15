<?php

use App\Http\Controllers\Api\CaminAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CaminAPIController::class)->group(function () {
    Route::get('/camin', 'index');
    Route::get('/camin/{camins_id}', 'show');
    Route::post('/camin', 'store');
    Route::put('/camin/{camins_id}', 'update');
    Route::delete('/camin/{camins_id}', 'destroy');
});
