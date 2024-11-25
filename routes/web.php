<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('index');
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{id}/toggle', [TaskController::class, 'toggle']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

