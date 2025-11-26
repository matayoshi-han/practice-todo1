<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;



Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
});
Route::resource('todos', TodoController::class);
Route::get('/todos/search', [TodoController::class, 'search']);
Route::resource('categories', CategoryController::class);