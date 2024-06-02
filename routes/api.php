<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ArticleController;
use App\Http\Controllers\Api\V1\ShortController;
use App\Http\Controllers\Api\V1\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// api/v1
// Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
//     Route::apiResource('articles', ArticleController::class);
//     Route::apiResource('categories', CategoryController::class);

    // Route::get('/assign-token/{userId}', [ArticleController::class, 'assignApiTokenManually']);
// });

// Public Routes (GET requests only)
Route::prefix('v1')->namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::get('articles', [ArticleController::class, 'index']); // List articles (public)
    Route::get('articles/{article}', [ArticleController::class, 'show']); // View a specific article (public)

    Route::get('shorts', [ShortController::class, 'index']); // List shorts (public)
    Route::get('shorts/{short}', [ShortController::class, 'show']); // List shorts (public)
    

    Route::get('categories', [CategoryController::class, 'index']); // List categories (public)

    Route::get('/assign-token/{userId}', [ArticleController::class, 'assignApiTokenManually']);
});

// Protected Routes (requires authentication for POST, PUT, DELETE)
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('articles', ArticleController::class)->only(['store', 'destroy']); // Exclude index and show actions from public access

    Route::apiResource('shorts', ShortController::class)->only(['store', 'destroy']);
    Route::put('shorts/{short}', [ShortController::class, 'update']);

    Route::apiResource('categories', CategoryController::class); // CRUD operations on categories (protected)
    
    // Route::apiResource('articles', ArticleController::class)->except('index', 'show');
    // Route::apiResource('shorts', ShortController::class)->except('index', 'show');
    // Route::apiResource('categories', CategoryController::class); 
});