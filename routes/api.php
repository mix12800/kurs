<?php

use App\Http\Controllers\OfficeController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('registration', [UserController::class, 'registration']);
Route::post('auth', [UserController::class, 'auth']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('spec', [SpecController::class, 'index']);
    Route::patch('user/{user}', [UserController::class, 'update']);
    Route::get('user/{user}', [UserController::class, 'show']);
    Route::delete('user/{user}', [UserController::class, 'destroy']);
    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class)->except('update', 'show', 'destroy');
        Route::resource('spec', SpecController::class)->except('index');
        Route::patch('user/{user}/role', [UserController::class, 'role']);
        Route::resource('office', OfficeController::class);
    });
});
