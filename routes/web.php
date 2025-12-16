<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// ==========================
// Kino sahifalari (public)
// ==========================
Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

// Reyting berish (faqat tizimga kirganlar)
Route::post('/movies/{movie}/rate', [MovieController::class, 'rate'])
    ->middleware('auth')
    ->name('movies.rate');

// ==========================
// Auth (login/register/logout)
// ==========================
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==========================
// Profil (tizimga kirgan foydalanuvchi)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    // Profilni ko‘rish
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Profilni tahrirlash form
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Profilni yangilash
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ==========================
// Admin sahifalari (kino qo‘shish/tahrirlash/ochirish)
// ==========================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Kino qo‘shish
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

    // Kino tahrirlash
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');

    // Kino o‘chirish
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});