<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MabarPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\TurnamenController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\TokoPointController;

Route::get('/', [MabarPostController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Postingan Mabar
    Route::get('/posting/buat', [MabarPostController::class, 'create'])->name('posting.create');
    Route::post('/posting/simpan', [MabarPostController::class, 'store'])->name('posting.store');
    Route::get('/posting/{id}/edit', [MabarPostController::class, 'edit'])->name('posting.edit');
    Route::put('/posting/{id}', [MabarPostController::class, 'update'])->name('posting.update');
    Route::delete('/posting/{id}', [MabarPostController::class, 'destroy'])->name('posting.destroy');
    Route::get('/cari-mabar', [MabarPostController::class, 'search'])->name('cari.mabar');

    // Komunitas
    Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas');
    Route::post('/komunitas', [KomunitasController::class, 'store'])->name('komunitas.store');
    Route::get('/komunitas/{id}/edit', [KomunitasController::class, 'edit'])->name('komunitas.edit');
    Route::put('/komunitas/{id}', [KomunitasController::class, 'update'])->name('komunitas.update');
    Route::delete('/komunitas/{id}', [KomunitasController::class, 'destroy'])->name('komunitas.destroy');

    // Turnamen
    Route::get('/turnamen', [TurnamenController::class, 'index'])->name('turnamen');
    Route::post('/turnamen', [TurnamenController::class, 'store'])->name('turnamen.store');
    Route::get('/turnamen/{id}/edit', [TurnamenController::class, 'edit'])->name('turnamen.edit');
    Route::put('/turnamen/{id}', [TurnamenController::class, 'update'])->name('turnamen.update');
    Route::delete('/turnamen/{id}', [TurnamenController::class, 'destroy'])->name('turnamen.destroy');

    // Artikel
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
    Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::post('/leaderboard', [LeaderboardController::class, 'store'])->name('leaderboard.store');
    Route::get('/leaderboard/{id}/edit', [LeaderboardController::class, 'edit'])->name('leaderboard.edit');
    Route::put('/leaderboard/{id}', [LeaderboardController::class, 'update'])->name('leaderboard.update');
    Route::delete('/leaderboard/{id}', [LeaderboardController::class, 'destroy'])->name('leaderboard.destroy');

    // Toko Point
    Route::get('/toko', [TokoPointController::class, 'index'])->name('toko.point');
    Route::post('/toko/redeem/{id}', [TokoPointController::class, 'redeem'])->name('toko.redeem');
    // Jika Toko Point juga butuh edit/hapus barang, rutenya ada di sini:
    Route::get('/toko/{id}/edit', [TokoPointController::class, 'edit'])->name('toko.edit');
    Route::put('/toko/{id}', [TokoPointController::class, 'update'])->name('toko.update');
    Route::delete('/toko/{id}', [TokoPointController::class, 'destroy'])->name('toko.destroy');
});

require __DIR__.'/auth.php';