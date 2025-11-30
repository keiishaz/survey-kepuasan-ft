<?php

use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\StatistikController;

Route::get('/', [\App\Http\Controllers\StatistikController::class, 'index'])->name('home');
Route::get('/survey', [KuesionerController::class, 'cariSurvey'])->name('survey');
Route::get('/cari-survey', [KuesionerController::class, 'cariSurvey'])->name('cari-survey');
Route::get('/isi-survey/{id}', [KuesionerController::class, 'isiSurvey'])->name('isi-survey');
Route::post('/isi-survey/{id}', [KuesionerController::class, 'storeJawaban'])->name('isi-survey.store');
Route::get('/isi-survey/{id}/selesai', [KuesionerController::class, 'selesai'])->name('isi-survey.selesai');
Route::post('/isi-survey/{id}/check-duplicate', [KuesionerController::class, 'checkDuplicate'])->name('isi-survey.check-duplicate');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/form', [KuesionerController::class, 'index'])->name('forms.index');
    Route::get('/form/tambah', [KuesionerController::class, 'create'])->name('forms.create');
    Route::post('/form', [KuesionerController::class, 'store'])->name('forms.store');
    Route::get('/form/{id}', [KuesionerController::class, 'show'])->name('forms.show');
    Route::get('/form/{id}/edit', [KuesionerController::class, 'edit'])->name('forms.edit');
    Route::put('/form/{id}', [KuesionerController::class, 'update'])->name('forms.update');
    Route::get('/form/{id}/edit-pertanyaan', [KuesionerController::class, 'editPertanyaan'])->name('forms.edit-pertanyaan');
    Route::put('/form/{id}/update-pertanyaan', [KuesionerController::class, 'updatePertanyaan'])->name('forms.update-pertanyaan');
    Route::get('/form/{id}/responden', [KuesionerController::class, 'lihatResponden'])->name('forms.responden');
    Route::get('/form/{id}/export-respon', [KuesionerController::class, 'exportResponden'])->name('forms.export-respon');
    Route::get('/form/{id}/export.{format}', [KuesionerController::class, 'exportLaporan'])->name('forms.export-laporan');
    Route::delete('/form/{id}', [KuesionerController::class, 'destroy'])->name('forms.destroy');
    Route::put('/form/{id}/update-status', [KuesionerController::class, 'updateManualStatus'])->name('forms.update-status');
    Route::get('/form/{id}/jawaban-distribusi', [KuesionerController::class, 'getJawabanDistribusi'])->name('forms.jawaban-distribusi');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/kategori/tambah', [KategoriController::class, 'create'])->name('kategori.tambah');
    Route::post('/kategori/simpan', [KategoriController::class, 'store'])->name('kategori.simpan');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori/{id}/hapus', [KategoriController::class, 'destroy'])->name('kategori.hapus');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/tambah', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('/admin/profil', [AdminController::class, 'editProfil'])->name('admin.profil');
    Route::put('/admin/profil/update', [AdminController::class, 'updateProfil'])->name('admin.update.profil');
    Route::put('/admin/profil/change-password', [AdminController::class, 'updatePassword'])->name('admin.update.password');

});

require __DIR__.'/auth.php';
