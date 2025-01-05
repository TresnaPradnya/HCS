<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommutingMethodController;
use App\Http\Controllers\DietaryPreferenceController;
use App\Http\Controllers\EnergySourceController;
use App\Http\Controllers\EducationalContentController;
use App\Http\Controllers\HistoricalTrackingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileUser;
use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

// Route untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Routes untuk login dan register
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerAttempt'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Routes yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Route untuk Profile
    Route::resource('profile', ProfileUser::class)->names('profile');

    // Route untuk Activity Log
    Route::resource('activity-log', ActivityLogController::class)->names('al');

    // Route untuk Educational Content
    Route::resource('educational-contents', EducationalContentController::class)
        ->names('educational-contents'); // CRUD untuk Educational Content
    Route::get('educational-contents/{content}/download', [EducationalContentController::class, 'download'])
        ->name('educational-contents.download');

    Route::middleware('auth')->group(function () {
        Route::resource('posts', PostController::class)->only(['index', 'store', 'create', 'show', 'destroy']);
    });

    Route::post('/posts/{post}/interact', [PostInteractionController::class, 'store'])->name('posts.interact');
    Route::post('/posts/{post}/unlike', [PostInteractionController::class, 'unlike'])->name('posts.unlike');

    // Route untuk Historical Trends
    Route::get('historical-trends', [ActivityLogController::class, 'historicalTrends'])->name('historical-trends.index');

    // Route untuk Recommendations
    Route::resource('recommendation', RecommendationController::class)->names('recommendation');

    // Route untuk Master Data
    Route::resource('master-data/energy_sources', EnergySourceController::class)->names('es');
    Route::resource('master-data/commuting_method', CommutingMethodController::class)->names('cm');
    Route::resource('master-data/dietary_preferences', DietaryPreferenceController::class)->names('dp');
});
