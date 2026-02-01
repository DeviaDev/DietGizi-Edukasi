<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DietCheckController;
use App\Http\Controllers\NutritionCalculatorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root - Redirect ke about jika sudah login, ke login jika belum
Route::get('/', function () {
    return redirect()->route('about');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Guest Routes (Belum Login)
// Route::middleware('guest')->group(function () {
// });


Route::middleware('auth')->group(function () {

    // Logout (WAJIB DI SINI)
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Nutrition (FITUR TERKUNCI)
    Route::prefix('nutrition')->name('nutrition.')->group(function () {

       Route::get('/beranda', [NutritionCalculatorController::class, 'beranda'])
            ->name('beranda');

        Route::get('/calculator', [NutritionCalculatorController::class, 'index'])
            ->name('calculator');

        Route::post('/calculate', [NutritionCalculatorController::class, 'calculate'])
            ->name('calculate');

        Route::get('/recommendations', [NutritionCalculatorController::class, 'recommendations'])
            ->name('recommendations');

        Route::post('/get-recommendations', [NutritionCalculatorController::class, 'getRecommendations'])
            ->name('getRecommendations');
    });
});




    // About Us (sebagai home)
    Route::get('/about', [PageController::class, 'about'])->name('about');
    
    // Edukasi Gizi
    Route::get('/edukasi-gizi', [PageController::class, 'edukasi'])->name('edukasi');
    
    // Dasar Gizi
    Route::get('/dasar-gizi', [PageController::class, 'dasarGizi'])->name('dasar-gizi');
    
    // Cek Diet
    Route::get('/cek-diet', [PageController::class, 'cekDiet'])->name('cek-diet');

    Route::get('/diet-check', [DietCheckController::class, 'index']);
    Route::post('/diet-check/calculate', [DietCheckController::class, 'calculate'])
     ->name('diet.calculate');
    Route::post('/cek-diet/calculate', [PageController::class, 'calculateDiet'])->name('cek-diet.calculate');