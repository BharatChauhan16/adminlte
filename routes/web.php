<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateuserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowuserController;
use Illuminate\Support\Facades\Artisan;
// use App\Http\Controllers\Auth\LoginController;



// LOGIN
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/admin/users', function () {
//     return view('home');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/users', [ShowuserController::class, 'index']);

// CREATE USERS
Route::get('/create-user', [CreateuserController::class, 'create'])->name('create-user');
Route::post('/add-users', [CreateuserController::class, 'addUsers'])->name('add-users');


Auth::routes();
