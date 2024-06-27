<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateuserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EdituserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreakController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/users', [HomeController::class, 'showUser'])->name('admin-users');
// Route::get('dashboard', [AttendanceController::class, 'index'])->name('dashboard');

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
Route::post('/clock-in', [HomeController::class, 'clockIn'])->name('clock-in');
Route::post('/clock-out', [HomeController::class, 'clockOut'])->name('clock-out');
Route::post('/save-productive-hours', [HomeController::class, 'saveProductiveHours'])->name('save-productive-hours');
Route::post('/save-break', [HomeController::class, 'saveBreak'])->name('save.break');
Route::post('/end-break/{id}', [HomeController::class, 'endBreak'])->name('end.break');
Route::get('/calculate-productive-hours', [HomeController::class, 'calculateProductiveHours'])->name('calculate-productive-hours');





Auth::routes();

