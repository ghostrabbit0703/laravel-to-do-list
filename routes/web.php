<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
Route::resource('tasks', TaskController::class);

Route::get('/', function () {
    return view('layout.app');
})->name('home');
