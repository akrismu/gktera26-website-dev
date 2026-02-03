<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;

Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');