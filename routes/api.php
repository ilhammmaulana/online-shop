<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryProductController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/refresh', [AuthController::class, 'refresh'])->middleware('auth.refresh');
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware([
    'auth.api'
])->group(function () {
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::delete('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('change-password', [AuthController::class, 'updatePassword']);
    });
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::post('profile', [AuthController::class, 'update']);
    });
    Route::resource('categories', CategoryProductController::class)->only('index');
    Route::prefix('products/favorite')->group(function () {
        Route::get('/', [FavoriteController::class, 'index']);
        Route::post('/', [FavoriteController::class, 'store']);
    });
    Route::resource('products', ProductController::class)->only('index', 'show');
});
