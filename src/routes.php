<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use AsagiriMoe\XenditWrapper\CallbackController;

Route::prefix('api')->group(function () {

    Route::group(['middleware' => ['api']], function () {
        Route::prefix('xendit')->group(function () {
            Route::post('callback', [CallbackController::class,'callback']);
        });
    });

});