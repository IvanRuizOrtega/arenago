<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use Src\Resources\Constants\Roles;
use Src\Resources\Constants\Routes;

Route::middleware('web')->group(function () {
    Route::post(
        Routes::BOOKING,
        [BookingController::class, 'create']
    )->name(Routes::BOOKING_CREATE)->middleware(['auth', 'role:' . Roles::CLIENT]);

    Route::get(
        Routes::BOOKING,
        [BookingController::class, 'index']
    )->name(Routes::BOOKING_INDEX)->middleware(['auth', 'role:' . Roles::COLLABORATOR]);

    Route::put(
        Routes::BOOKING . '/{id}/edit',
        [BookingController::class, 'edit']
    )->name(Routes::BOOKING_EDIT)->middleware(['auth', 'role:' . Roles::COLLABORATOR]);

    Route::get(
        Routes::BOOKING . '/{id}/teams',
        [BookingController::class, 'team']
    )->name(Routes::BOOKING_TEAM)->middleware(['auth', 'role:' . Roles::CLIENT]);

    Route::put(
        Routes::BOOKING . '/{id}/teams',
        [BookingController::class, 'saveTeam']
    )->name(Routes::BOOKING_TEAM_UPDATE)->middleware(['auth', 'role:' . Roles::CLIENT]);

    Route::get(
        Routes::BOOKING . '/{id}/close',
        [BookingController::class, 'closeForm']
    )->name(Routes::BOOKING_TEAM_CLOSE_FORM)->middleware(['auth', 'role:' . Roles::CLIENT]);

    Route::put(
        Routes::BOOKING . '/{id}/close',
        [BookingController::class, 'close']
    )->name(Routes::BOOKING_TEAM_CLOSE)->middleware(['auth', 'role:' . Roles::CLIENT]);
});

Route::post(
    Routes::BOOKING . '/{id}/available-players',
    [BookingController::class, 'getAvailablePlayers']
);
