<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodmenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiPembelianController;

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

Route::prefix('superadmin')->middleware('auth')->name('superadmin.')->group(function () {
    Route::resource('menu', FoodmenuController::class)->except('show');
    Route::resource('transaksiPembelian', TransaksiPembelianController::class)->except('show');
    Route::resource('transaksi', TransaksiController::class)->except('show');
    Route::post('/add_transaksi_menu', [TransaksiController::class, 'tambah_transaksi_menu'])
        ->name('transaksi_menu');
    Route::put('/update_transaksi_menu/{id}', [TransaksiController::class, 'update_transaksi_menu'])
        ->name('transaksi_update');
    Route::get('/cetak_struk/{id}', [TransaksiController::class, 'cetak_struk'])
        ->name('cetak_struk');

    Route::get('/login', function () {
        return view('auth.login');
    })->middleware('guest');

    Route::get('/dashboard', [FoodmenuController::class, 'dashboard'])
        ->middleware(['auth'])->name('dashboard');
});
