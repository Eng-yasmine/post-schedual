<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\UserController;
use App\Http\Controllers\Apis\Posts\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', action: 'logout')->middleware('auth:sanctum');
});
Route::controller(UserController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', action: 'logout')->middleware('auth:sanctum');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class);

});
