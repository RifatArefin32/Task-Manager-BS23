<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;

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

Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    // tasks
    Route::get("/alltasks", [TasksController::class, 'all']);
    Route::post("/tasks/create", [TasksController::class, 'create']);
    Route::get("/tasks/retrieve", [TasksController::class, 'retrieve']);
    Route::put("/tasks/update/{id}", [TasksController::class, 'update']);
    Route::delete("/tasks/delete/{id}", [TasksController::class, 'delete']);

    // un - auth
    Route::get("/me", [UserController::class, 'me']);
    Route::post("/logout", [UserController::class, 'logout']);
});