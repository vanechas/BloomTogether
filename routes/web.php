<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GardenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/about', [LandingController::class, 'about'])->name('about');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'reset'])->name('password.reset');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::get('/journal', [JournalController::class, 'index'])->name('journal');
    Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
    Route::delete('/journal/{entry}', [JournalController::class, 'destroy'])->name('journal.destroy');
    
    Route::get('/garden', [GardenController::class, 'index'])->name('garden');
    Route::get('/garden/entries', [GardenController::class, 'getEntriesByDate'])->name('garden.entries');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/friendlist', [FriendController::class, 'index'])->name('friendlist');
    Route::post('/friendlist/request', [FriendController::class, 'sendRequest'])->name('friendship.request');
    Route::post('/friendlist/{friendship}/accept', [FriendController::class, 'acceptRequest'])->name('friendship.accept');
    Route::delete('/friendlist/{friendship}/decline', [FriendController::class, 'declineRequest'])->name('friendship.decline');
    Route::delete('/friendlist/{friendship}/cancel', [FriendController::class, 'cancelRequest'])->name('friendship.cancel');
    Route::get('/friendlist/{friend}/garden', [FriendController::class, 'viewGarden'])->name('friend.garden');
});