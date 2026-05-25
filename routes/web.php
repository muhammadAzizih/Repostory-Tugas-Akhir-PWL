<?php

use Illuminate\Support\Facades\Route;           
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;

//PUBLIK
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/skripsi/{id}', [WelcomeController::class, 'show'])->name('skripsi.show');

Auth::routes(['register' => false]);

//BUTUH LOGIN
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/skripsi/{id}/download-skripsi', [WelcomeController::class, 'downloadSkripsi'])->name('skripsi.download');
    
    //PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    //MAHASISWA
    Route::middleware(['role:Mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('dashboard');
        Route::get('/upload-sktl', [MahasiswaController::class, 'createSktl'])->name('sktl.create');
        Route::post('/upload-sktl', [MahasiswaController::class, 'storeSktl'])->name('sktl.store');
        Route::get('/reupload-sktl', [MahasiswaController::class, 'reuploadSktl'])->name('sktl.reupload');
        Route::post('/reupload-sktl', [MahasiswaController::class, 'storeReuploadSktl'])->name('sktl.storeReupload');
        Route::get('/upload-files', [MahasiswaController::class, 'createFiles'])->name('files.create');
        Route::post('/upload-files', [MahasiswaController::class, 'storeFiles'])->name('files.store');
        Route::get('/reupload-files', [MahasiswaController::class, 'reuploadFiles'])->name('files.reupload');
        Route::post('/reupload-files', [MahasiswaController::class, 'storeReuploadFiles'])->name('files.storeReupload');
        Route::get('/status', [MahasiswaController::class, 'status'])->name('status');
    });

});