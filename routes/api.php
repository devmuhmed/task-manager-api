<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class);
Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::apiResource('tasks', TaskController::class);
    Route::put('change-priority/{task}', [TaskController::class, 'changePriority']);
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
});
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');
