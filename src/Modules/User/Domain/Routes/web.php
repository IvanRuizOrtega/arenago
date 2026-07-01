<?php

use Illuminate\Support\Facades\Route;
use Src\Resources\Constants\Routes;
use App\Http\Controllers\UserFriendController;
use App\Http\Controllers\UserController;
use Src\Resources\Constants\Roles;

Route::middleware('web')->group(function () {
    Route::get(
        Routes::USERS,
        [UserController::class, 'index']
    )->name(Routes::USERS_INDEX)->middleware(['auth', 'role:' . Roles::ADMIN]);

    Route::get(
        Routes::USERS . '/{id}',
        [UserController::class, 'show']
    )->name(Routes::USERS_SHOW)->middleware(['auth', 'role:' . Roles::ADMIN]);

    Route::put(
        Routes::USERS . '/{id}',
        [UserController::class, 'update']
    )->name(Routes::USERS_UPDATE)->middleware(['auth', 'role:' . Roles::ADMIN]);
});

Route::post(
    Routes::USERS . '/toggle-friend',
    [UserFriendController::class, 'toggle']
)->name(Routes::USERS_FRIENDS);
