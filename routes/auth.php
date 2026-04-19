<?php
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('gestion-interna/login', [AuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('gestion-interna/login', [AuthController::class, 'login'])
    ->name('admin.login.post');

Route::post('gestion-interna/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');