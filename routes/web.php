<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SampelUjiController;
use App\Http\Controllers\Admin\ParameterSampelController;
use App\Http\Controllers\Admin\PejabatController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\PengujianOrderController;


use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboardController;
use App\Http\Controllers\Pelanggan\PengujianController as PelangganPengujianController;
use App\Http\Controllers\Pelanggan\ProfilController as PelangganProfilController;

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

//BAGIAN ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('index');
    });
    //master
    Route::prefix('sampel-uji')->name('sampel-uji.')->group(function () {
        Route::get('', [SampelUjiController::class, 'index'])->name('index');
        Route::post('store', [SampelUjiController::class, 'store'])->name('store');
        Route::put('update', [SampelUjiController::class, 'update'])->name('update');
        Route::delete('delete', [SampelUjiController::class, 'delete'])->name('delete');
    });
    //master
    Route::prefix('parameter-sampel')->name('parameter-sampel.')->group(function () {
        Route::get('', [ParameterSampelController::class, 'index'])->name('index');
        Route::post('store', [ParameterSampelController::class, 'store'])->name('store');
        Route::put('update', [ParameterSampelController::class, 'update'])->name('update');
        Route::delete('delete', [ParameterSampelController::class, 'delete'])->name('delete');
    });
    //master
    Route::prefix('pejabat')->name('pejabat.')->group(function () {
        Route::get('', [PejabatController::class, 'index'])->name('index');
        Route::post('store', [PejabatController::class, 'store'])->name('store');
        Route::put('update', [PejabatController::class, 'update'])->name('update');
        Route::delete('delete', [PejabatController::class, 'delete'])->name('delete');
    });

    Route::prefix('akun')->name('akun.')->group(function () {
        Route::get('', [AkunController::class, 'index'])->name('index');
        Route::post('store', [AkunController::class, 'store'])->name('store');
        Route::put('update', [AkunController::class, 'update'])->name('update');
        Route::delete('delete', [AkunController::class, 'delete'])->name('delete');

        Route::get('pelanggan', [AkunController::class, 'pelangganIndex'])->name('pelangganIndex');
        Route::put('pelangganVerif', [AkunController::class, 'pelangganVerif'])->name('pelangganVerif');
        Route::delete('pelangganDelete', [AkunController::class, 'pelangganDelete'])->name('pelangganDelete');
    });

    Route::prefix('pengujian')->name('pengujian.')->group(function () {
        Route::get('', [PengujianOrderController::class, 'index'])->name('index');
        Route::get('getOrder/{id}', [PengujianOrderController::class, 'getOrder'])->name('getOrder');
        Route::put('gantiStatus', [PengujianOrderController::class, 'gantiStatus'])->name('gantiStatus');
        Route::get('cetakLaporanSementara', [PengujianOrderController::class, 'cetakLaporanSementara'])->name('cetakLaporanSementara');
        Route::get('cetakSertifikat', [PengujianOrderController::class, 'cetakSertifikat'])->name('cetakSertifikat');
        // Route::post('store', [PejabatController::class, 'store'])->name('store');
        // Route::put('update', [PejabatController::class, 'update'])->name('update');
        // Route::delete('delete', [PejabatController::class, 'delete'])->name('delete');
    });
});

//bagian pelanggan
Route::prefix('pelanggan')->name('pelanggan.')->middleware(['auth', 'isPelanggan'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('', [PelangganDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('pengujian')->name('pengujian.')->group(function () {
        Route::get('', [PelangganPengujianController::class, 'index'])->name('index');
        Route::post('createOrder', [PelangganPengujianController::class, 'createOrder'])->name('createOrder');
        Route::delete('deleteOrder', [PelangganPengujianController::class, 'deleteOrder'])->name('deleteOrder');
        Route::post('sampel', [PelangganPengujianController::class, 'sampel'])->name('sampel');
        Route::get('getOrder/{id}', [PelangganPengujianController::class, 'getOrder'])->name('getOrder');
        Route::get('getParameter/{id}', [PelangganPengujianController::class, 'getParameter'])->name('getParameter');
       
        Route::post('createSampelParameter', [PelangganPengujianController::class, 'createSampelParameter'])->name('createSampelParameter');
        Route::delete('deleteSampelParameter', [PelangganPengujianController::class, 'deleteSampelParameter'])->name('deleteSampelParameter');

        Route::post('sendOrder', [PelangganPengujianController::class, 'sendOrder'])->name('sendOrder');
        Route::get('tracking/{id}', [PelangganPengujianController::class, 'tracking'])->name('tracking');

    });

    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('changePassword/{id}', [PelangganProfilController::class, 'changePassword'])->name('changePassword');
        Route::put('savePassword/{id}', [PelangganProfilController::class, 'savePassword'])->name('savePassword');
    });
});


// innovation-report.store0/{id}

// Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
// Route::get('dropdownlist','DataController@getCountries');
// Route::get('dropdownlist/getstates/{id}','DataController@getStates');
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

