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

Route::get('/api/global/first', [RoleController::class, 'first']);

Route::group([
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/api/global/admin', function (Request $request) {
        $user = $request->user();
        $image = $user->imageAccount()->first();
        $imageId = ($image == null ? -1 : $image->imageId);
        $user['image'] = App\Models\Image::where('imageId', '=', $imageId)->first();
        if ($user->nameRole == 'admin') {
            return $user;
        }
        return ['message' => 'You are not authorized'];
    });
    Route::get('/api/global/user', function (Request $request) {
        $user = $request->user();
        $image = $user->imageAccount()->first();
        $imageId = ($image == null ? -1 : $image->imageId);
        $user['image'] = App\Models\Image::where('imageId', '=', $imageId)->first();
        return $request->user();
    });
    Route::get('/api/global/roles', [RoleController::class, 'findAll']);
    Route::get('/api/global/staffs', [StaffController::class, 'findAll']);

    Route::get('/api/global/staffs/{id}', [StaffController::class, 'findOne']);

    Route::post('/api/global/roles', [RoleController::class, 'create']);
    Route::post('/api/global/staffs', [StaffController::class, 'create']);

    Route::put('/api/global/roles/{id}', [RoleController::class, 'update']);
    Route::put('/api/global/staffs/{id}', [StaffController::class, 'update']);

    Route::delete('/api/global/roles/{id}', [RoleController::class, 'delete']);
    Route::delete('/api/global/staffs/{id}', [StaffController::class, 'delete']);
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'api/local'
], function () {
    Route::get('/user', function (Request $request) {
        
        $user = $request->user();
        $image = $user->imageAccount()->first();
        $imageId = ($image == null ? -1 : $image->imageId);
        $user['image'] = App\Models\Image::where('imageId', '=', $imageId)->first();
        return $request->user();
    });
});