<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('property', PropertyController::class)->except(['show']);
    Route::resource('option', OptionController::class)->except(['show']);
});
///
Route::prefix('biens')->name('property.')->group(function () use ($idRegex, $slugRegex) {
    Route::get('/', [PropertyController::class, 'Doindex'])->name('index');
    Route::get('/{slug}-{property}', [PropertyController::class, 'show'])
        ->where(['property' => $idRegex, 'slug' => $slugRegex])
        ->name('show');

    Route::post('/{property}/contact', [PropertyController::class, 'contact'])
        ->where(['property' => $idRegex])
        ->name('contact');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('doLogin');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'doRegister']);