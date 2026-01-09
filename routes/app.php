<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('/tasks', TaskController::class);
Route::get('/tasks/{id}/completed', [TaskController::class, 'completed'])->name('tasks.completed');
Route::get('/tasks/{id}/pending', [TaskController::class, 'pending'])->name('tasks.pending');