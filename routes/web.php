<?php

use App\Http\Controllers\MainController;
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

//Home route
Route::get('/', [MainController::class, 'index']);
Route::get('/teacher/{id}/classes', [MainController::class, 'classes']);
Route::get('/class/{id}', [MainController::class, 'classes']);

//Api routes
Route::get('/get-teachers', [MainController::class, 'teachers']);
Route::get('/class/{id}/get-students', [MainController::class, 'students']);


