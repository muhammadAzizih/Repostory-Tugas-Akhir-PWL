<?php

use Illuminate\Support\Facades\Route;           
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\OperatorController;


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


    // === KAPRODI ===
    Route::middleware(['role:Kaprodi'])->prefix('kaprodi')->name('kaprodi.')->group(function () {
        Route::get('/dashboard', [KaprodiController::class, 'index'])->name('dashboard');
        Route::get('/persetujuan', [KaprodiController::class, 'indexPersetujuan'])->name('persetujuan');
        Route::post('/approve/{id}', [KaprodiController::class, 'approve'])->name('approve');
        Route::get('/analitik', [KaprodiController::class, 'analitik'])->name('analitik');
    });

    // === OPERATOR ===
    Route::middleware(['role:Operator'])->prefix('operator')->name('operator.')->group(function () {
        Route::get('/dashboard', [OperatorController::class, 'index'])->name('dashboard');
        
        // Kelola Mahasiswa
        Route::get('/students', [OperatorController::class, 'indexStudents'])->name('students.index');
        Route::get('/students/create', [OperatorController::class, 'createStudent'])->name('students.create');
        Route::post('/students', [OperatorController::class, 'storeStudent'])->name('students.store');
        Route::get('/students/{id}/edit', [OperatorController::class, 'editStudent'])->name('students.edit');
        Route::put('/students/{id}/update', [OperatorController::class, 'updateStudent'])->name('students.update');
        Route::delete('/students/{id}/delete', [OperatorController::class, 'destroyStudent'])->name('students.destroy');
        
        // Verifikasi
        Route::get('/verifikasi-sktl', [OperatorController::class, 'indexSktl'])->name('verifikasi.sktl');
        Route::get('/skripsi/{id}/sktl', [OperatorController::class, 'downloadSktl'])->name('sktl.download');
        Route::post('/verifikasi-sktl/{id}/verify', [OperatorController::class, 'verifySktl'])->name('verifikasi.sktl.verify');
        Route::post('/verifikasi-sktl/{id}/reject', [OperatorController::class, 'rejectSktl'])->name('verifikasi.sktl.reject');
        
        Route::get('/verifikasi-files', [OperatorController::class, 'indexFiles'])->name('verifikasi.files');
        Route::post('/verifikasi-files/{id}/verify', [OperatorController::class, 'verifyFiles'])->name('verifikasi.files.verify');
        Route::post('/verifikasi-files/{id}/reject', [OperatorController::class, 'rejectFiles'])->name('verifikasi.files.reject');
        
        // Riwayat & Statistik
        Route::get('/riwayat', [OperatorController::class, 'riwayat'])->name('riwayat');
        Route::get('/publikasi', [OperatorController::class, 'indexPublished'])->name('publikasi');
        Route::delete('/skripsi/{id}', [OperatorController::class, 'destroySkripsi'])->name('skripsi.destroy');
        Route::get('/statistik', [OperatorController::class, 'statistik'])->name('statistik');

    });

});