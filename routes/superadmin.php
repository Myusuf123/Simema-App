<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodmenuController;
use App\Http\Controllers\TransaksiController;

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
    Route::resource('transaksi', TransaksiController::class)->except('show');

    Route::get('/login', function () {
        return view('auth.login');
    })->middleware('guest');

    Route::get('/dashboard', [FoodmenuController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth'])->name('dashboard');
});
