<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index'])->name('home');

// Rutas para filtrar archivos por rango de años
Route::get('/work/{startYear}-{endYear}', [WebsiteController::class, 'archivesByYearRange'])
    ->where(['startYear' => '[0-9]+', 'endYear' => '[0-9]+'])
    ->name('work.year-range');

// Ruta de archivo individual
Route::get('/work/{startYear}-{endYear}/archive/{slug}', [WebsiteController::class, 'archive'])
    ->where(['startYear' => '[0-9]+', 'endYear' => '[0-9]+'])
    ->name('archive');

// Ruta de biografía
Route::get('/susan-schmidt', [WebsiteController::class, 'biography'])->name('biography');
// Rutas de exhibiciones
Route::get('/exhibitions', [WebsiteController::class, 'exhibitions'])->name('exhibitions');
// Rutas de artículos
Route::get('/articles', [WebsiteController::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [WebsiteController::class, 'article'])->name('article');

// Rutas de administración
Route::redirect('/auth/login', '/login');
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', [ArchiveController::class, 'index'])->name('dashboard');

    // CRUD Archives
    Route::get('/archives/create', [ArchiveController::class, 'create'])->name('archives.create');
    Route::post('/archives', [ArchiveController::class, 'store'])->name('archives.store');
    Route::get('/archives/{archive}/edit', [ArchiveController::class, 'edit'])->name('archives.edit');
    Route::patch('/archives/{archive}', [ArchiveController::class, 'update'])->name('archives.update');
    Route::delete('/archives/{archive}', [ArchiveController::class, 'destroy'])->name('archives.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
