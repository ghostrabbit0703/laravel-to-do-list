<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;

Route::apiResource('categories', CategoryController::class)
    ->names('api.categories');

Route::apiResource('tags', TagController::class)
    ->names('api.tags');

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */
