<?php

use App\Http\Controllers\CaminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CaminController::class)->group(function () {
    Route::get('/camin', 'index');
    Route::get('/camin/create', 'create');
    Route::post('/camin', 'store');
    Route::get('/camin/{camins_id}', 'show');
    Route::get('/camin/{camins_id}/edit', 'edit');
    Route::put('/camin/{camins_id}', 'update');
    Route::delete('/camin/{camins_id}', 'destroy');
});