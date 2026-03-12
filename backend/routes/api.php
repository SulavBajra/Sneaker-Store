<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\ProductHomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('api.login');
Route::get('/home', [ProductHomeController::class, 'index'])->name('api.home');

Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::post('/logout', LogoutController::class)->name('api.logout');
});
