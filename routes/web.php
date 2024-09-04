<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::post('/pasien/store', [WelcomeController::class, 'store'])->name('pasien.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::post('/pasien/store', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/pasien/details/{id}', [PasienController::class, 'show'])->name('pasien.details');
    Route::delete('/pasien/destroy/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
    Route::put('/pasien/edit/{id}', [PasienController::class, 'edit'])->name('pasien.edit');

    // Route::get('/pasien/cetak/pdf', [PeriksaController::class, 'exportPDF'])->name('export.pdf');
    // Route::get('/pasien/cetak/excel', [PeriksaController::class, 'exportExcel'])->name('export.excel');

    Route::get('/anak', [AnakController::class, 'index'])->name('anak.index');

    Route::get('/kader', [KaderController::class, 'index'])->name('kader.index');
    Route::post('/kader/store', [KaderController::class, 'store'])->name('kader.store');
    Route::delete('/kader/destroy/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    Route::get('/periksa', [PeriksaController::class, 'index'])->name('periksa.index');
    Route::get('/periksa/{id}', [PeriksaController::class, 'show'])->name('periksa.show');
    Route::post('/periksa', [PeriksaController::class, 'store'])->name('periksa.store');
    // Route::get('/acara', [AcaraController::class, 'index'])->name('acara.index');
});

require __DIR__.'/auth.php';
