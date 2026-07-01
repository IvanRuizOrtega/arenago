<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyStaffController;
use Src\Resources\Constants\Roles;
use Src\Resources\Constants\Routes;

Route::middleware('web')->group(function () {
    Route::get(
        Routes::MY_STAFF,
        [MyStaffController::class, 'index']
    )->name(Routes::MY_STAFF_INDEX)->middleware(['auth', 'role:' . Roles::OWNER]);

    Route::get(
        Routes::MY_MATCHDAY_HUB,
        [MyStaffController::class, 'myMatchdayHub']
    )->name(Routes::MY_MATCHDAY_HUB_INDEX)->middleware(['auth', 'role:' . Roles::CLIENT]);
});
