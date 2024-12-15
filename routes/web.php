<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommutingMethodController;
use App\Http\Controllers\DietaryPreferenceController;
use App\Http\Controllers\EnergySourceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileUser;
use App\Http\Controllers\EducationalContentController;
use App\Http\Controllers\HistoricalTrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These   |
| routes are loaded by the RouteServiceProvider and all of them will      |
| be assigned to the "web" middleware group. Make something great!         |
*/

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('login');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerAttempt'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('profile', ProfileUser::class)->names('profile')->middleware('auth');
Route::resource('activity-log', ActivityLogController::class)->names('al')->middleware('auth');

Route::resource('master-data/energy_sources', EnergySourceController::class)->names('es');
Route::resource('master-data/commuting_method', CommutingMethodController::class)->names('cm');
Route::resource('master-data/dietary_preferences', DietaryPreferenceController::class)->names('dp');

// Routes untuk Educational Content (Epic 6)
Route::middleware('auth')->group(function () {
    Route::resource('educational-contents', EducationalContentController::class)
        ->names('educational-contents'); // Menangani CRUD untuk konten edukasi

    Route::get('educational-contents', [EducationalContentController::class, 'index'])
        ->name('educational-contents.index');


    Route::get('educational-contents/{content}/download', [EducationalContentController::class, 'download'])
        ->name('educational-contents.download');
});
