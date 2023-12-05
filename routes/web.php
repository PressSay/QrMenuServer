<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

<<<<<<< HEAD
Route::get('/', function (Request $request) {
    if ($request->lang == 'vn') {
        App::setLocale('vn');
    }
    $tableId = $request->tableOrder;
    $categoryId = $request->categoryId;
    $name = $request->name;
    App\Models\Category::findOrFail($categoryId);

    if (is_numeric($tableId) && $tableId > 0 && $tableId < DB::table('tableOrder')->count()) {
        $dishBuilder = App\Models\Dish::Where('categoryId', $categoryId);
        if ($name) {
            $dishBuilder->where('name', 'like', '%' . $name . '%');
        }
        $arrDish = $dishBuilder->get();
        return view('menu', ['tableId' => $tableId, 'categoryId' => $categoryId, 'dishes' => $arrDish]);
    }
    abort(404);
})->name('menus');


Route::get('/categories', function (Request $request) {
    if ($request->lang == 'vn') {
        App::setLocale('vn');
    }
    $tableId = $request->tableOrder;
    $categoryId = $request->categoryId;
    $name = $request->name;
    App\Models\Category::findOrFail($categoryId);

    if (is_numeric($tableId) && $tableId > 0 && $tableId < DB::table('tableOrder')->count()) {
        $categoryBuilder = App\Models\Category::where('name', 'like', '%' . $name . '%');
        $arrCategory = $categoryBuilder->get();
        return view('genre', ['tableId' => $tableId, 'categoryId' => $categoryId, 'categories' => $arrCategory]);
    }
    abort(404);
})->name('categories');

Route::get('/confirm', function (Request $request) {
    if ($request->lang == 'vn') {
        App::setLocale('vn');
    }
    $tableId = $request->tableOrder;
    $categoryId = $request->categoryId;
    App\Models\Category::findOrFail($categoryId);

    if (is_numeric($tableId) && $tableId > 0 && $tableId < DB::table('tableOrder')->count()) {
        return view('cfm-menu', ['tableId' => $tableId, 'categoryId' => $categoryId]);
    }

    abort(404);
})->name('confirm');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
=======
Route::get('/', function () {
    App\Events\OrderNotification::dispatch();
    return null;
    // return ['Laravel' => app()->version()];
>>>>>>> 3126c1cb7291b969b408e8be6a78fb5da74cf0bc
});

Route::get('/api/global/env', function () {
    return env('CODE_STAFF');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/image.php';
require __DIR__ . '/menu.php';
require __DIR__ . '/customer.php';
require __DIR__ . '/api.php';