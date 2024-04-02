<?php

use Illuminate\Support\Facades\Route;
use Modules\Communicator\App\Http\Controllers\V1\MessageController;
use Modules\Communicator\App\Http\Controllers\V1\TemplateController;


Route::prefix('templates/v1')->group(function () {
    Route::resource(
        'templates' , TemplateController::class,
    );
});
Route::prefix('messages/v1')->group(function () {
    Route::resource(
        'messages', MessageController::class,
    );
});