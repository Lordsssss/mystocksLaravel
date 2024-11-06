<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController; // Add this if you have an AdminController
use App\Http\Controllers\ModeratorController; // Add this if you have a ModeratorController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Language Setting Route
Route::get('/set-language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    Session::save();

    App::setLocale($lang);

    // Redirect back
    return redirect()->back();
})->name('set-language');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Apply 'auth', 'verified', and 'setlocale' Middleware to Authenticated Routes
Route::middleware(['auth', 'setlocale'])->group(function () {
    // Admin Routes (Only accessible by admin)
    Route::middleware('role:0')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/upgrade/{user_id}', [AdminController::class, 'upgradeToModerator'])->name('admin.upgrade');
        Route::post('/admin/demote/{user_id}', [AdminController::class, 'demoteToUser'])->name('admin.demote'); // Demote route
    });
    Route::middleware(['auth'])->get('/buy-stock', function () {
        return view('buy_stock'); // This assumes your Blade file is named `buy_stock.blade.php`
    })->name('buy-stock');
    // Moderator Routes (Accessible by admin and moderator)
    Route::middleware('role:1')->group(function () {
        Route::get('/moderator', [ModeratorController::class, 'index'])->name('moderator.dashboard');
        // Add other moderator routes here
    });

    // Routes accessible by all authenticated users
    Route::resource('stocks', StockController::class);
    Route::get('/news', [NewsController::class, 'index'])->name('news');

    // Account Routes
    Route::get('/account', [AccountController::class, 'edit'])->name('account');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');

    // Home Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Homepage Route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Auth::routes(['verify' => true]);
