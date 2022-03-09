<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

//Page routes
Route::get('/', [MainController::class, 'index']);
Route::get('/teacher/{id}/classes', [MainController::class, 'classes']);


//======= Api routes =======//
Route::get('/get-teachers', [MainController::class, 'teachers']);
//return teachers classes
Route::get('/class/{id}', [MainController::class, 'classes']);
//return students in class
Route::get('/class/{id}/get-students', [MainController::class, 'students']);
//return extended details on student
Route::get('/students/{id}/extended-details', [MainController::class, 'getStudentDetails']);

