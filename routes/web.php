<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\SmallFormatController;

Route::get('/', [WebsiteController::class, 'index'])->name('home');

// Rutas para filtrar archivos por rango de años
Route::get('/work/{startYear}-{endYear}', [WebsiteController::class, 'archivesByYearRange'])
    ->where(['startYear' => '[0-9]+', 'endYear' => '[0-9]+'])
    ->name('work.year-range');

// Ruta de archivo individual
Route::get('/work/{startYear}-{endYear}/archive/{slug}', [WebsiteController::class, 'archive'])
    ->where(['startYear' => '[0-9]+', 'endYear' => '[0-9]+'])
    ->name('archive');

// Rutas para Small Formats (público)
Route::get('/small-format', [WebsiteController::class, 'smallFormats'])->name('small-formats');
Route::get('/small-format/{slug}', [WebsiteController::class, 'smallFormat'])->name('small-format');

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

    // CRUD Small Formats
    Route::get('/small-formats', [SmallFormatController::class, 'index'])->name('small-formats.index');
    Route::get('/small-formats/create', [SmallFormatController::class, 'create'])->name('small-formats.create');
    Route::post('/small-formats', [SmallFormatController::class, 'store'])->name('small-formats.store');
    Route::get('/small-formats/{smallFormat}/edit', [SmallFormatController::class, 'edit'])->name('small-formats.edit');
    Route::patch('/small-formats/{smallFormat}', [SmallFormatController::class, 'update'])->name('small-formats.update');
    Route::delete('/small-formats/{smallFormat}', [SmallFormatController::class, 'destroy'])->name('small-formats.destroy');

    // CRUD Exhibitions
    Route::get('/exhibitions', [ExhibitionController::class, 'index'])->name('exhibitions.index');
    Route::get('/exhibitions/create', [ExhibitionController::class, 'create'])->name('exhibitions.create');
    Route::post('/exhibitions', [ExhibitionController::class, 'store'])->name('exhibitions.store');
    Route::get('/exhibitions/{exhibition}/edit', [ExhibitionController::class, 'edit'])->name('exhibitions.edit');
    Route::patch('/exhibitions/{exhibition}', [ExhibitionController::class, 'update'])->name('exhibitions.update');
    Route::delete('/exhibitions/{exhibition}', [ExhibitionController::class, 'destroy'])->name('exhibitions.destroy');

    // CRUD Articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // CRUD Social Links
    Route::get('/social-links', [SocialLinkController::class, 'index'])->name('social-links.index');
    Route::get('/social-links/create', [SocialLinkController::class, 'create'])->name('social-links.create');
    Route::post('/social-links', [SocialLinkController::class, 'store'])->name('social-links.store');
    Route::get('/social-links/{socialLink}/edit', [SocialLinkController::class, 'edit'])->name('social-links.edit');
    Route::patch('/social-links/{socialLink}', [SocialLinkController::class, 'update'])->name('social-links.update');
    Route::delete('/social-links/{socialLink}', [SocialLinkController::class, 'destroy'])->name('social-links.destroy');
    Route::patch('/social-links/{socialLink}/toggle', [SocialLinkController::class, 'toggle'])->name('social-links.toggle');
    Route::post('/social-links/reorder', [SocialLinkController::class, 'reorder'])->name('social-links.reorder');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
