<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// account
Route::get('/account', function () {
    return view('account.index');
})->name('account');
Route::get('/account/create', function () {
    return view('account.create');
})->name('account.create');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pegawai', [AdminController::class, 'pegawai'])->name('pegawai');
    Route::get('/pegawai/create', [AdminController::class, 'tambahPegawai'])->name('pegawai.create');
    Route::post('/pegawai/store', [AdminController::class, 'simpanPegawai'])->name('pegawai.store');
    Route::get('/pegawai/{id}/edit', [AdminController::class, 'editPegawai'])->name('pegawai.edit');
    Route::post('/pegawai/{id}/update', [AdminController::class, 'updatePegawai'])->name('pegawai.update');
    Route::delete('/pegawai/{id}/delete', [AdminController::class, 'hapusPegawai'])->name('pegawai.destroy');
    Route::get('/account', [AdminController::class, 'account'])->name('account');
    Route::get('/account/create', [AdminController::class, 'tambahAccount'])->name('account.create');
    Route::post('/account/store', [AdminController::class, 'simpanAccount'])->name('account.store');
    Route::get('/account/{id}/edit', [AdminController::class, 'editAccount'])->name('account.edit');
    Route::post('/account/{id}/update', [AdminController::class, 'updateAccount'])->name('account.update');
    Route::delete('/account/{id}/delete', [AdminController::class, 'hapusAccount'])->name('account.destroy');
    Route::get('/detail_account', [AdminController::class, 'detailAccount'])->name('detail_account');
    Route::get('/detail_account/create', [AdminController::class, 'createDetailAccount'])->name('detail_account.create');
    Route::post('/detail_account/store', [AdminController::class, 'storeDetailAccount'])->name('detail_account.store');
    Route::get('/detail_account/{id}/edit', [AdminController::class, 'editDetailAccount'])->name('detail_account.edit');
    Route::post('/detail_account/{id}/update', [AdminController::class, 'updateDetailAccount'])->name('detail_account.update');
    Route::delete('/detail_account/{id}/delete', [AdminController::class, 'deleteDetailAccount'])->name('detail_account.destroy');
});


Route::prefix('keuangan')->name('keuangan.')->group(function () {
    Route::get('/saldo', [BendaharaController::class, 'saldo'])->name('saldo');
    Route::get('/saldo/create', [BendaharaController::class, 'tambahSaldo'])->name('saldo.create');
    Route::post('/saldo/store', [BendaharaController::class, 'simpanSaldo'])->name('saldo.store');
    Route::get('/pemasukan', [BendaharaController::class, 'pemasukan'])->name('pemasukan');
    Route::get('/pemasukan/create', [BendaharaController::class, 'createPemasukan'])->name('pemasukan.create');
    Route::post('/pemasukan/store', [BendaharaController::class, 'storePemasukan'])->name('pemasukan.store');
    Route::get('/pemasukan/{id}/edit', [BendaharaController::class, 'editPemasukan'])->name('pemasukan.edit');
    Route::post('/pemasukan/{id}/update', [BendaharaController::class, 'updatePemasukan'])->name('pemasukan.update');
    Route::delete('/pemasukan/{id}/delete', [BendaharaController::class, 'deletePemasukan'])->name('pemasukan.destroy');
    Route::get('/pengeluaran', [BendaharaController::class, 'pengeluaran'])->name('pengeluaran');
    Route::get('/pengeluaran/create', [BendaharaController::class, 'createPengeluaran'])->name('pengeluaran.create');
    Route::post('/pengeluaran/store', [BendaharaController::class, 'storePengeluaran'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{id}/create_detail', [BendaharaController::class, 'createDetailPengeluaran'])->name('pengeluaran.create_detail');
    Route::post('/pengeluaran/store_detail', [BendaharaController::class, 'storeDetailPengeluaran'])->name('pengeluaran.store_detail');
    Route::post('/pengeluaran/upload_struk', [BendaharaController::class, 'uploadStruk'])->name('pengeluaran.upload_struk');
    Route::get('/pengeluaran/detail/{id}', [BendaharaController::class, 'detailPengeluaran'])->name('pengeluaran.detail');
});

Route::get('/dashboard', [BendaharaController::class, 'index'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
});


// bendahara
Route::get('/saldo', function () {
    return view('bendahara.saldo.index');
})->name('saldo');
Route::get('/saldo/create', function () {
    return view('bendahara.saldo.create');
})->name('saldo.create');

Route::get('/pemasukan', function () {
    return view('bendahara.pemasukan.index');
})->name('pemasukan');
Route::get('/pemasukan/create', function () {
    return view('bendahara.pemasukan.create');
})->name('pemasukan.create');

require __DIR__ . '/auth.php';
