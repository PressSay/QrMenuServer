<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api'
], function ($router) {
    
    Route::get('/customers', [CustomerController::class, 'findAll']);
    Route::get('/tables', [CustomerController::class, 'findAllTable']);
    Route::get('/investments', [CustomerController::class, 'findAllInvestment']);
    
    Route::get('/customers/{id}', [CustomerController::class, 'findOne']);
    Route::get('/tables/{id}', [CustomerController::class, 'findOneTable']);

    Route::post('/customers', [CustomerController::class, 'createCustomer']);
    Route::post('/tables', [CustomerController::class, 'createTable']);
    Route::post('/investments', [CustomerController::class, 'createInvestment']);

    Route::put('/customers/{id}', [CustomerController::class, 'updateCustomer']);
    Route::put('/tables/{id}', [CustomerController::class, 'updateTable']);

    Route::delete('/customers/{id}', [CustomerController::class, 'deleteCustomer']);
    Route::delete('/investments/{id}', [CustomerController::class, 'deleteInvestment']);

});