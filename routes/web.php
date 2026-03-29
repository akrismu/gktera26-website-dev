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

// News
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Churches
Route::get('/churches', [ChurchController::class, 'index'])->name('churches.index');
Route::get('/churches/{slug}', [ChurchController::class, 'show'])->name('churches.show');

// About
Route::get('/about', [AboutController::class, 'sinode'])->name('about.index');
Route::get('/about/history', [AboutController::class, 'history'])->name('about.history');
Route::get('/about/mission', [AboutController::class, 'mission'])->name('about.mission');
Route::get('/about/ministrys', [AboutController::class, 'ministry'])->name('about.ministry');
Route::get('/about/ministrys/{slug}', [AboutController::class, 'ministryShow'])->name('about.ministry.show');
Route::get('/about/newsletters', [AboutController::class, 'newsletters'])->name('about.newsletters');
Route::get('/about/newsletters/{newsletter}/download', [AboutController::class, 'newsletterDownload'])->name('about.newsletter.download');