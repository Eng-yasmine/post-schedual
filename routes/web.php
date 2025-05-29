<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\platformpostController;

Route::get('/', [PagesController::class, 'index'])->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('platforms', PlatformController::class);
    Route::resource('platform_posts', platformpostController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/test-log', function () {
//     Log::info("✅ Test log from Yasmine - Checking log works!");
//     return 'Logged!';
// });


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
