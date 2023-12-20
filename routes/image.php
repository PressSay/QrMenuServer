<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;


Route::group([

    'middleware' => 'auth:sanctum',
    'prefix' => 'api/global'

], function ($router) {
    Route::post('/images', [ImageController::class, 'create']);
});