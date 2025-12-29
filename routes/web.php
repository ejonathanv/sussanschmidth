<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
