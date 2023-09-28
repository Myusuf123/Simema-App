<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodmenuController;

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

Route::prefix('customer')->group(function () {
    Route::resource('menu', FoodmenuController::class)->except('show');
    Route::get('/daftar_makanan', [FoodmenuController::class, 'menu_makanan'])
        ->name('customer.menu_makanan');
    Route::get('/daftar_minuman', [FoodmenuController::class, 'menu_minuman'])
        ->name('customer.menu_minuman');
    Route::get('/daftar_cemilan', [FoodmenuController::class, 'menu_cemilan'])
        ->name('customer.menu_cemilan');
    Route::get('/daftar_catering', [FoodmenuController::class, 'menu_catering'])
        ->name('customer.menu_catering');
});

Route::get('/', function () {
    return view('customer.dashboard');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/superadmin.php';
