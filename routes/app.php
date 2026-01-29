<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollsController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('/tasks', TaskController::class);
Route::get('/tasks/{id}/completed', [TaskController::class, 'completed'])->name('tasks.completed');
Route::get('/tasks/{id}/pending', [TaskController::class, 'pending'])->name('tasks.pending');

Route::resource('/employees', EmployeeController::class);

Route::resource('/departments', DepartmentController::class);

Route::resource('/roles', RoleController::class);

Route::resource('/presences', PresenceController::class);

Route::resource('/payrolls', PayrollsController::class);

Route::resource('/leave-requests', LeaveController::class);
Route::get('/leave-requests/{id}/confirmed', [LeaveController::class, 'confirmed'])->name('leave-requests.confirmed');
Route::get('/leave-requests/{id}/rejected', [LeaveController::class, 'rejected'])->name('leave-requests.rejected');