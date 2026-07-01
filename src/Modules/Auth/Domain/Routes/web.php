<?php

use Illuminate\Support\Facades\Route;
use Src\Resources\Constants\Routes;
use App\Http\Controllers\AuthController;


Route::middleware('web')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name(Routes::LOGOUT);
    Route::get('/auth/google/redirect', [AuthController::class, 'redirectGoogle'])->name(Routes::GOOGLE_LOGIN);
    Route::get('/auth/google/callback', [AuthController::class, 'loginGoogle'])->name(Routes::GOOGLE_CALLBACK);
    Route::get('/auth/change-role/', [AuthController::class, 'changeRole'])->name(Routes::CHANGE_ROLE);
});
