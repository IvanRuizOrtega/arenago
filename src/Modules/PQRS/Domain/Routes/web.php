<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PQRSController;
use Src\Resources\Constants\Routes;

Route::middleware('web')->group(function () {

    Route::post(
        Routes::PQRS,
        [PQRSController::class, 'create']
    )->name(Routes::PQRS_CREATE);

    Route::get(
        Routes::PQRS,
        [PQRSController::class, 'createForm']
    )->name(Routes::PQRS_CREATE_FORM);
});
