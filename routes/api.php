<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodGroupController;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\BadgeController;
use App\Http\Controllers\Api\DonorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::apiResource('blood_groups', BloodGroupController::class)->only(['index']);
Route::apiResource('campaigns', CampaignController::class)->only(['index']);
Route::apiResource('badges', BadgeController::class)->only(['index']);
Route::apiResource('donors', DonorController::class)->only(['index']);
