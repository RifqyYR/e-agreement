<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LainnyaController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\SewaBangunanController;
use App\Http\Controllers\SewaKendaraanController;
use App\Http\Controllers\TUKSTERSUSController;
use App\Http\Controllers\UPPController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Tambah
    Route::get('/tambah-perjanjian', [AgreementController::class, 'create'])->name('tambah-perjanjian');
    Route::post('/proses-tambah-perjanjian', [AgreementController::class, 'uploadProcess']);

    // Arsip
    Route::get('/proses-arsip/{id}', [AgreementController::class, 'archiveProcess'])->name('arsip.proses');

    // Edit
    Route::get('/edit/{agreement:id}', [AgreementController::class, 'edit'])->name('edit');
    Route::put('/edit/{id}', [AgreementController::class, 'editProcess'])->name('edit.proses');

    // Perpanjang
    Route::get('/perpanjang/{agreement:id}', [AgreementController::class, 'extends'])->name('perpanjang');
    Route::put('/perpanjang/{id}', [AgreementController::class, 'extendProcess'])->name('perpanjang.proses');
    // Delete
    Route::get('/delete/{id}', [AgreementController::class, 'delete']);
    Route::get('/delete-arsip/{id}', [ArchiveController::class, 'delete']);

    // Register
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/proses-register', [RegisterController::class, 'registerProcess'])->name('proses.register');

    // User Management
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user-edit/{user:id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/proses-edit-user', [UserController::class, 'editProcess'])->name('edit.user.proses');
    Route::get('/delete-user/{id}', [UserController::class, 'delete'])->name('delete.user.proses');
    Route::get('/ganti-password/{user:id}', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::post('/proses-ganti-password/{user:id}', [UserController::class, 'changePasswordProcess'])->name('user.change-password.process');
});

// Route Halaman Perjanjian
Route::get('/sarpras', [SarprasController::class, 'sarpras'])->middleware(['auth', 'verified']);
Route::get('/sewa-bangunan', [SewaBangunanController::class, 'sewaBangunan'])->middleware(['auth', 'verified']);
Route::get('/sewa-kendaraan', [SewaKendaraanController::class, 'sewaKendaraan'])->middleware(['auth', 'verified']);
Route::get('/tuks-tersus', [TUKSTERSUSController::class, 'tuksTersus'])->middleware(['auth', 'verified']);
Route::get('/upp', [UPPController::class, 'upp'])->middleware(['auth', 'verified']);
Route::get('/lainnya', [LainnyaController::class, 'lainnya'])->middleware(['auth', 'verified']);

// Route searching function
Route::post('/sarpras/search', [SarprasController::class, 'search'])->name('sarpras.search');
Route::post('/sewa-bangunan/search', [SewaBangunanController::class, 'search'])->name('sewaBangunan.search');
Route::post('/sewa-kendaraan/search', [SewaKendaraanController::class, 'search'])->name('sewaKendaraan.search');
Route::post('/tuks-tersus/search', [TUKSTERSUSController::class, 'search'])->name('tuksTersus.search');
Route::post('/upp/search', [UPPController::class, 'search'])->name('upp.search');
Route::post('/lainnya/search', [LainnyaController::class, 'search'])->name('lainnya.search');
Route::post('/arsip/search', [ArchiveController::class, 'search'])->name('archive.search');

// Detail route
Route::get('/detail/{agreement:id}', [AgreementController::class, 'detail'])->name('detail')->middleware(['auth', 'verified']);

// Detail Archive Route
Route::get('/detailArsip/{archive:id}', [ArchiveController::class, 'detail'])->name('archive.detail')->middleware(['auth', 'verified']);

// Archive Page Route
Route::get('/arsip', [ArchiveController::class, 'index'])->name('archive')->middleware(['auth', 'verified']);

// Logout
Route::post('/logout', [HomeController::class, 'logout']);

Auth::routes(['verify' => false, 'register' => false, 'reset' => false]);
