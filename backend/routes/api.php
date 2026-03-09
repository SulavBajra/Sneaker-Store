<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
<<<<<<< Updated upstream
=======

Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::post('/logout', LogoutController::class)->name('api.logout');
});
>>>>>>> Stashed changes
