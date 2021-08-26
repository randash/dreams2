<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/supervisor', [LoginController::class,'showSupervisorLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::get('/register/supervisor', [RegisterController::class,'showSupervisorRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/supervisor', [LoginController::class,'supervisorLogin']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']);
Route::post('/register/supervisor', [RegisterController::class,'createSupervisor']);

Route::group(['middleware' => 'auth:supervisor'], function () {
    Auth::routes();
    Route::view('/supervisor', 'supervisor');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Auth::routes();
    Route::view('/admin', 'admin');
});
Route::get('logout', [LoginController::class,'logout']);
