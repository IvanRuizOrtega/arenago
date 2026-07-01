<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayingFieldController;
use Src\Resources\Constants\Routes;

Route::get(
    Routes::PLAYING_FIELD . '/{id}/available-hours',
    [PlayingFieldController::class, 'avaliableHours']
);
