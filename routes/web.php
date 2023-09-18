<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LainnyaController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\SewaBangunanController;
use App\Http\Controllers\SewaKendaraanController;
use App\Http\Controllers\TUKSTERSUSController;
use App\Http\Controllers\UPPController;
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

// Route tambah perjanjian
Route::get('/tambah-perjanjian', [AgreementController::class, 'create'])
    ->name('tambah-perjanjian')->middleware(['auth', 'verified']);
Route::post('/proses-tambah-perjanjian', [AgreementController::class, 'uploadProcess'])->middleware(['auth', 'verified']);

// Detail route
Route::get('/detail/{agreement:id}', [AgreementController::class, 'detail'])->name('detail')->middleware(['auth', 'verified']);

// Edit Route
Route::get('/edit/{agreement:id}', [AgreementController::class, 'edit'])->name('edit')->middleware(['auth', 'verified']);

Route::post('/logout', [HomeController::class, 'logout']);

Auth::routes(['verifiy' => true]);
