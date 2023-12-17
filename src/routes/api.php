<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Enums\TokenAbility;
use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\C_reminders;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});
Route::middleware('auth:sanctum', 'ability:' . TokenAbility::ACCESS_API->value)->group(function () {
        Route::post('/reminders', [C_reminders::class, 'create']);
        Route::get('/reminders', [C_reminders::class, 'list']);
        Route::get('/reminders/{id}', [C_reminders::class, 'views']);
        Route::put('/reminders/{id}', [C_reminders::class, 'edit']);
        Route::delete('/reminders/{id}', [C_reminders::class, 'delete']);

    });
Route::put('/session', [\App\Http\Controllers\Api\AuthController::class, 'refreshToken']);
    