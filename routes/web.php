<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\Admin\CampaignController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::redirect('/', '/login', 301);

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('blood_groups', BloodGroupController::class);
    Route::resource('users', UserController::class);
    Route::resource('badges', BadgeController::class);
    Route::resource('campaigns', CampaignController::class);
});



