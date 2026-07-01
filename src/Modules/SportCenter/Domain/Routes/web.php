<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SportCenterController;
use Src\Resources\Constants\Roles;
use Src\Resources\Constants\Routes;

Route::middleware('web')->group(function () {

    Route::get(
        Routes::MY_SPORT_CENTER . '/create',
        [SportCenterController::class, 'createForm']
    )->name(Routes::SPORT_CENTER_CREATE_FORM)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::post(
        Routes::SPORT_CENTER,
        [SportCenterController::class, 'create']
    )->name(Routes::SPORT_CENTER_CREATE)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::get(
        Routes::SPORT_CENTER . '/edit/{id}',
        [SportCenterController::class, 'editForm']
    )->name(Routes::SPORT_CENTER_EDIT_FORM)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::put(
        Routes::SPORT_CENTER . '/edit/{id}',
        [SportCenterController::class, 'edit']
    )->name(Routes::SPORT_CENTER_EDIT)->middleware(['web', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::delete(
        Routes::SPORT_CENTER . '/forget/{id}',
        [SportCenterController::class, 'forget']
    )->name(Routes::SPORT_CENTER_FORGET)->middleware(['web', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::get(
        Routes::SPORT_CENTER,
        [SportCenterController::class, 'index']
    )->name(Routes::SPORT_CENTER_INDEX)->middleware(['auth', 'role:' . Roles::CLIENT]);

    Route::get(
        Routes::SPORT_CENTER . '/{id}',
        [SportCenterController::class, 'show']
    )->name(Routes::SPORT_CENTER_SHOW)->middleware(['auth', 'role:' . Roles::CLIENT]);

    Route::get(
        Routes::MY_SPORT_CENTER,
        [SportCenterController::class, 'my']
    )->name(Routes::MY_SPORT_CENTER_INDEX)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::get(
        Routes::MY_SPORT_CENTER . '/{id}/show',
        [SportCenterController::class, 'myShow']
    )->name(Routes::MY_SPORT_CENTER_SHOW)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::get(
        Routes::MY_SPORT_CENTER . '/{id}/create',
        [SportCenterController::class, 'myCreateForm']
    )->name(Routes::MY_SPORT_CENTER_CREATE_FORM)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::post(
        Routes::MY_SPORT_CENTER . '/{id}/create',
        [SportCenterController::class, 'myCreate']
    )->name(Routes::MY_SPORT_CENTER_CREATE)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::get(
        Routes::MY_SPORT_CENTER . '/{id}/playing-fields/{playing_field_id}/show',
        [SportCenterController::class, 'myPlayingFieldShow']
    )->name(Routes::MY_SPORT_CENTER_PLAYING_FIELD_SHOW)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::get(
        Routes::MY_SPORT_CENTER . '/{id}/playing-fields/{playing_field_id}',
        [SportCenterController::class, 'myEditForm']
    )->name(Routes::MY_SPORT_CENTER_EDIT_FORM)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::put(
        Routes::MY_SPORT_CENTER . '/{id}/playing-fields/{playing_field_id}',
        [SportCenterController::class, 'myUpdate']
    )->name(Routes::MY_SPORT_CENTER_EDIT_FORM)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);

    Route::delete(
        Routes::MY_SPORT_CENTER . '/{id}/playing-fields/{playing_field_id}',
        [SportCenterController::class, 'myForget']
    )->name(Routes::MY_SPORT_CENTER_EDIT_FORGET)->middleware(['auth', 'role:' . Roles::ADMIN . ',' . Roles::OWNER]);
});
