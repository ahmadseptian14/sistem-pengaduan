<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasyarakatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TanggapanController;


use App\Models\Pengaduan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// User
Route::middleware(['auth', 'user'])->group(function() {


    //Pengaduan 
    Route::get('/input-pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/input-pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan', [PengaduanController::class, 'pengaduan'])->name('pengaduan.all');

    // Penilaian
    Route::get('/input-penilaian', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('/input-penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');

});
   

// Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Pengaduan Masyarakat
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/detail-pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::get('/cetak-laporan', [PengaduanController::class, 'cetakForm'])->name('cetak.form');
    Route::get('/cetak-data-pengaduan', [PengaduanController::class, 'cetak'])->name('cetak.laporan');

    // Tanggapan
    Route::get('/tanggapan/{id}', [TanggapanController::class, 'show'])->name('tanggapan.show');
    Route::post('/tanggapan', [TanggapanController::class, 'store'])->name('tanggapan.store');

    // Petugas
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/input-petugas', [PetugasController::class, 'create'])->name('petugas.create');
    Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');

    // Masyarakat
    Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat.index');
    Route::get('/masyarakat-create', [MasyarakatController::class, 'create'])->name('masyarakat.create');
    Route::get('/masyarakat-edit/{id}', [MasyarakatController::class, 'edit'])->name('masyarakat.edit');
    Route::put('/masyarakat/{id}', [MasyarakatController::class, 'update'])->name('masyarakat.update');
    Route::delete('/masyarakat/{id}', [MasyarakatController::class, 'destroy'])->name('masyarakat.destroy');

    // Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');


});

Auth::routes();
