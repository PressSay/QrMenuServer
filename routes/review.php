<?php

use App\Http\Controllers\ReviewController;

Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'api/global'
    // 'middleware' => 'guest',
], function () {
    Route::get('/reviews/bill', [ReviewController::class, 'findAllRevBill']);
    Route::get('/reviews/dish', [ReviewController::class, 'findAllRevDish']);
    Route::get('/reviews/dish/{dishId}/{customerId}', [ReviewController::class, 'findOneRevDish']);
    Route::get('/reviews/bill/{customerId}', [ReviewController::class, 'findOneRevBill']);

    Route::post('/reviews/bill', [ReviewController::class, 'createRevBill']);
    Route::post('/reviews/dish', [ReviewController::class, 'createRevDish']);

    Route::put('/reviews/bill/{customerId}', [ReviewController::class, 'updateRevBill']);
    Route::put('/reviews/dish/{dishId}/{customerId}', [ReviewController::class, 'updateRevDish']);

    Route::delete('/reviews/bill/{id}', [ReviewController::class, 'deleteRevBill']);
    Route::delete('/reviews/dish/{dishId}/{customerId}', [ReviewController::class, 'deleteRevDish']);
});