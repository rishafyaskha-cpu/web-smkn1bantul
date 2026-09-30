<?php

use App\Http\Controllers\Admin\AchievementController as AdminAchievementController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\GalleryPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramKeahlianController;
use App\Http\Controllers\SaranaPrasaranaController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TeachingFactoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/sejarah', [ProfileController::class, 'sejarah'])->name('sejarah');
Route::get('/visi-dan-misi', [ProfileController::class, 'visiMisi'])->name('visi-misi');
Route::get('/struktur-organisasi', [ProfileController::class, 'strukturOrganisasi'])->name('struktur-organisasi');

Route::get('/sarana-prasarana', [SaranaPrasaranaController::class, 'index'])->name('sarana-prasarana.index');
Route::get('/sarana-prasarana/{saranaPrasarana}', [SaranaPrasaranaController::class, 'show'])->name('sarana-prasarana.show');

Route::get('/program-keahlian', [ProgramKeahlianController::class, 'index'])->name('program-keahlian.index');
Route::get('/program-keahlian/{programKeahlian}', [ProgramKeahlianController::class, 'show'])->name('program-keahlian.show');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/download', [DownloadController::class, 'index'])->name('download');

Route::get('/ekstrakurikuler', [GalleryPageController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
Route::get('/organisasi-siswa', [GalleryPageController::class, 'organisasiSiswa'])->name('organisasi-siswa');

Route::get('/teaching-factory', [TeachingFactoryController::class, 'index'])->name('teaching-factory');
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

Route::post('/chatbot', [ChatController::class, 'store'])
    ->middleware('throttle:'.config('services.chatbot.per_ip_per_minute', 10).',1')
    ->name('chatbot.ask');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->middleware('throttle:6,1');
});

Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');

    Route::resource('articles', AdminArticleController::class)->except('show');
    Route::resource('achievements', AdminAchievementController::class)->except('show');
});
