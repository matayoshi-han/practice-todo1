<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;



Route::middleware('auth')->group(function () {
    Route::get('/todos', [TodoController::class, 'index']);
    Route::get('/todos/search', [TodoController::class, 'search']);
    Route::resource('todos', TodoController::class);
    Route::resource('categories', CategoryController::class);
});
