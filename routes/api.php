<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\UserController;

use App\Http\Controllers\Apis\posts\ApiPostController;
use App\Http\Controllers\Apis\platforms\ApiPlatformController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', action: 'logout')->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', ApiPostController::class);
    Route::get('platforms', [ApiPlatformController::class,'index']);
    Route::post('platforms', [ApiPlatformController::class,'store']);
    Route::post('platforms/toggle', [ApiPlatformController::class, 'toggle']);

});
