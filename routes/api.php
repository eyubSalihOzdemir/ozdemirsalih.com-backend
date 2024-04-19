<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ArticleController;
use App\Http\Controllers\Api\V1\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// api/v1
// Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
//     Route::apiResource('articles', ArticleController::class);
//     Route::apiResource('categories', CategoryController::class);

//     // Route::get('/assign-token/{userId}', [ArticleController::class, 'assignApiTokenManually']);
// });

// Public Routes (GET requests only)
Route::prefix('v1')->namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::get('articles', [ArticleController::class, 'index']); // List articles (public)
    Route::get('articles/{article}', [ArticleController::class, 'show']); // View a specific article (public)
    Route::get('categories', [CategoryController::class, 'index']); // List categories (public)
});

// Protected Routes (requires authentication for POST, PUT, DELETE)
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('articles', ArticleController::class)->except(['index', 'show']); // Exclude index and show actions from public access
    Route::apiResource('categories', CategoryController::class); // CRUD operations on categories (protected)
});