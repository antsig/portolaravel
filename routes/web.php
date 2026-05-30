<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/download-cv', [HomeController::class, 'downloadCv'])->name('download-cv');
