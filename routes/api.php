<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/api/first', [RoleController::class, 'first']);

Route::group([
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/api/admin', function (Request $request) {
        $user = $request->user();
        $image = $user->imageAccount()->first();
        $imageId = ($image == null ? -1 : $image->imageId);
        $user['image'] = App\Models\Image::where('imageId', '=', $imageId)->first();
        if ($user->nameRole == 'admin') {
            return $user;
        }
        return ['message' => 'You are not authorized'];
    });
    Route::get('/api/user', function (Request $request) {
        $user = $request->user();
        $image = $user->imageAccount()->first();
        $imageId = ($image == null ? -1 : $image->imageId);
        $user['image'] = App\Models\Image::where('imageId', '=', $imageId)->first();
        return $request->user();
    });
    Route::get('/api/roles', [RoleController::class, 'findAll']);
    Route::get('/api/staffs', [StaffController::class, 'findAll']);

    Route::get('/api/staffs/{id}', [StaffController::class, 'findOne']);

    Route::post('/api/roles', [RoleController::class, 'create']);
    Route::post('/api/staffs', [StaffController::class, 'create']);

    Route::put('/api/roles/{id}', [RoleController::class, 'update']);
    Route::put('/api/staffs/{id}', [StaffController::class, 'update']);

    Route::delete('/api/roles/{id}', [RoleController::class, 'delete']);
    Route::delete('/api/staffs/{id}', [StaffController::class, 'delete']);
});