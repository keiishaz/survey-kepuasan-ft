<?php

use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KuesionerController;

Route::get('/', function () {
    return view('landing');
})->name('home');

// Route::get('/form', function () {
//     return view('form');
// })->name('form');
// Route::get('/form/tambah', function () {
//     return view('tambah-form');
// })->name('tambahform');
// Route::get('/detailform', function () {
//     return view('detail-form');
// })->name('detailform');

// Route::get('/kategori', function () {
//     return view('kategori');
// })->name('kategori');





Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/form', [KuesionerController::class, 'index'])->name('forms.index');
    Route::get('/form/tambah', [KuesionerController::class, 'create'])->name('forms.create');
    Route::post('/form', [KuesionerController::class, 'store'])->name('forms.store');
    Route::get('/form/{id}', [KuesionerController::class, 'show'])->name('forms.show');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/kategori/tambah', [KategoriController::class, 'create'])->name('kategori.tambah');
    Route::post('/kategori/simpan', [KategoriController::class, 'store'])->name('kategori.simpan');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('/kategori/{id}/hapus', [KategoriController::class, 'destroy'])->name('kategori.hapus');



    // Route::redirect('settings', 'settings/profile');

    // Route::get('settings/profile', Profile::class)->name('settings.profile');
    // Route::get('settings/password', Password::class)->name('settings.password');
    // Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
