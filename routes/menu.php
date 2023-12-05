<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DishController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;

Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'api/global'
    // 'middleware' => 'guest',
], function () {
    Route::get('/menus', [MenuController::class, 'findAll']);
    Route::get('/categories', [CategoryController::class, 'findAll']);
    Route::get('/dishes', [DishController::class, 'findAll']);
    Route::get('/reviews', [ReviewController::class, 'findAll']);

    Route::get('/menus/{id}', [MenuController::class, "findOne"]);
    Route::get('/categories/{id}', [CategoryController::class, 'findOne']);
    Route::get('/dishes/{id}', [DishController::class,'findOne']);
    Route::get('/reviews/{id}', [ReviewController::class,'findOne']);

    Route::post('/menus', [MenuController::class, 'create']);
    Route::post('/categories', [CategoryController::class, 'create']);
    Route::post('/dishes', [DishController::class, 'create']);
    Route::post('/reviews', [ReviewController::class, 'create']);

    Route::put('/menus/{id}', [MenuController::class, 'update']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::put('dishes/{id}', [DishController::class, 'update']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);

    Route::delete('/menus/{id}', [MenuController::class, 'delete']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']);
    Route::delete('dishes/{id}', [DishController::class, 'delete']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'delete']);

    Route::delete('/reviews', [ReviewController::class, 'deleteAll']);
});

Route::group([
    'prefix' => 'api/local'
], function () {
    Route::get('/menus', [MenuController::class, 'findAll']);
    Route::get('/categories', [CategoryController::class, 'findAll']);
    Route::get('/dishes', [DishController::class, 'findAll']);
    Route::get('/reviews', [ReviewController::class, 'findAll']);

    Route::get('/menus/{id}', [MenuController::class, "findOne"]);
    Route::get('/categories/{id}', [CategoryController::class, 'findOne']);
    Route::get('/dishes/{id}', [DishController::class,'findOne']);
    Route::get('/reviews/{id}', [ReviewController::class,'findOne']);
});
