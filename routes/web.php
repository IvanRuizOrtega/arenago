<?php

use Illuminate\Support\Facades\Route;
use Src\Resources\Constants\Routes;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name(Routes::WELCOME);
