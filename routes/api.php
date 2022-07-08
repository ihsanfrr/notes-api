<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\SubcategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function() {
    Route::post('/user/signup', [UserController::class, 'signup']);
    Route::post('/user/login', [UserController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/user/logout', [UserController::class, 'logout']);

        Route::get('/category', [CategoryController::class, 'index']);
        Route::post('/category', [CategoryController::class, 'store']);
        Route::post('/category/{category}', [CategoryController::class, 'update']);
        Route::delete('/category/{category}', [CategoryController::class, 'destroy']);
        
        Route::get('/subcategory', [SubcategoryController::class, 'index']);
        Route::post('/subcategory', [SubcategoryController::class, 'store']);
        Route::post('/subcategory/{subcategory}', [SubcategoryController::class, 'update']);
        Route::delete('/subcategory/{subcategory}', [SubcategoryController::class, 'destroy']);
        
        Route::get('/note', [NoteController::class, 'index']);
        Route::post('/note', [NoteController::class, 'store']);
        Route::post('/note/{note}', [NoteController::class, 'update']);
        Route::delete('/note/{note}', [NoteController::class, 'destroy']);
    });
});
