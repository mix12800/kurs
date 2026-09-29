<?php

use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Ticket;
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
    Route::get('schedule', [ScheduleController::class, 'index']);
    Route::delete('user/{user}', [UserController::class, 'destroy']);
    Route::get('ticket/{schedule}', [TicketController::class, 'index']);

    Route::middleware('role:admin|user')->group(function () {
        Route::patch('ticket/{ticket}', [TicketController::class, 'update']);
        Route::patch('ticket/сancel/{ticket}', [TicketController::class, 'сancel']);
        Route::get('tickets/{user}', [TicketController::class, 'mytickets']);
        Route::get('my/ticket/{ticket}', [TicketController::class, 'myticket']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class)->except('update', 'show', 'destroy');
        Route::resource('spec', SpecController::class)->except('index');
        Route::patch('user/{user}/role', [UserController::class, 'role']);
        Route::resource('office', OfficeController::class);
        Route::resource('schedule', ScheduleController::class)->except('index');
    });
});
