<?php

use Illuminate\Support\Facades\Route;
use Modules\Communicator\App\Http\Controllers\V1\MessageController;
use Modules\Communicator\App\Http\Controllers\V1\TemplateController;


Route::prefix('v1')->group(function () {
    Route::resource('templates', TemplateController::class);
    Route::resource('messages', MessageController::class);
});
