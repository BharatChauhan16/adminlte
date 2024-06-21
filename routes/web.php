<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateuserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowuserController;
use App\Http\Controllers\EdituserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreakController;
use Illuminate\Support\Facades\Artisan;
// use App\Http\Controllers\Auth\LoginController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/users', [HomeController::class, 'showUser'])->name('admin-users');

// CREATE USERS
Route::get('/create-user', [CreateuserController::class, 'create'])->name('create-user');
Route::post('/add-users', [CreateuserController::class, 'addUsers'])->name('add-users');

// EDIT USERS
Route::get('/edit-user/{id}', [EdituserController::class, 'edit'])->name('edit-user');
Route::post('/update-profile', [EdituserController::class, 'editUser'])->name('update-profile');
Route::put('/users/update/{id}', [EdituserController::class, 'update'])->name('users.update');

// ADD PERMISSIONS
Route::get('/add-permission', [PermissionController::class, 'index'])->name('add-permission');
Route::post('/save-permission', [PermissionController::class, 'store'])->name('save-permission');

// Edit PERMISSIONS
Route::get('/edit-permissions/{id}', [PermissionController::class, 'editPermission'])->name('edit-permissions');
Route::post('/save-permissions', [PermissionController::class, 'savePermission'])->name('save-permissions');

//ATTENDANCE AND BREAKS
// Attendance Routes
// Ensure these routes are protected by authentication middleware
Route::middleware(['auth'])->group(function () {
    Route::post('/clockin', [AttendanceController::class, 'clockIn'])->name('clockin');
    Route::post('/clockout', [AttendanceController::class, 'clockOut'])->name('clockout');
});

// Break Routes
Route::post('/breaks/start', [BreakController::class, 'startBreak'])->name('breaks.start');
Route::post('/breaks/{id}/end', [BreakController::class, 'endBreak'])->name('breaks.end');

Auth::routes();
