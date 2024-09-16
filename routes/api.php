<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController; 

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

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    // Route for user login
    Route::post('login', 'login');
    // Route for user logout
    Route::post('logout', 'logout');
});

// Protected Routes (Requires Authentication and Verification)
Route::middleware(['auth:api', 'verified'])->group(function () {
    // Define routes for ProjectController
    Route::resource('projects', ProjectController::class);

    // Define routes for TaskController
    Route::resource('tasks', TaskController::class);

    // Define routes for UserController (using API resource)
    // This includes routes for index, store, show, update, and destroy actions
    Route::apiResource('users', UserController::class); 
});
