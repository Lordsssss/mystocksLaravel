<?php

use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;

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

// Language Setting Route
Route::get('/set-language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    Session::save();

    App::setLocale($lang);

    // Log for debugging
    Log::info('Language set to: ' . $lang);
    Log::info('Session locale is now: ' . Session::get('locale'));
    Log::info('Application Locale set to: ' . App::getLocale());

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

// Apply 'auth' and 'setlocale' Middleware to Authenticated Routes
Route::middleware(['auth', 'setlocale'])->group(function () {
    // Stock Routes
    Route::resource('stocks', StockController::class);

    // News Routes
    Route::get('/news', [NewsController::class, 'index'])->name('news');

    // Account Routes
    Route::get('/account', [AccountController::class, 'edit'])->name('account'); // Account edit form
    Route::put('/account', [AccountController::class, 'update'])->name('account.update'); // Account update action

    // Home Route (after login)
    Route::get('/home', [HomeController::class, 'index'])->middleware('verified')->name('home');
});

// Homepage Route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Auth::routes(['verify' => true]);
