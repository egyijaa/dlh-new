<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SampelUjiController;
use App\Http\Controllers\Admin\ParameterSampelController;
use App\Http\Controllers\Admin\PejabatController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\PengujianOrderController;
use App\Http\Controllers\Admin\PengujianSelesaiOrderController;
use App\Http\Controllers\Admin\PengambilanSampelOrderController;
use App\Http\Controllers\Admin\PengambilanSampelSelesaiController;


use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboardController;
use App\Http\Controllers\Pelanggan\PengujianController as PelangganPengujianController;
use App\Http\Controllers\Pelanggan\PengujianSelesaiController as PelangganPengujianSelesaiController;
use App\Http\Controllers\Pelanggan\PengambilanSampelController as PelangganPengambilanSampelController;
use App\Http\Controllers\Pelanggan\PengambilanSampelSelesaiController as PelangganPengambilanSampelSelesaiController;
use App\Http\Controllers\Pelanggan\ProfilController as PelangganProfilController;
use App\Http\Controllers\Pelanggan\DaftarHargaController as PelangganDaftarHargaController;

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
        Route::get('apiwithoutkey', [DashboardController::class, 'apiWithoutKey'])->name('apiWithoutKey');
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

    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('changePassword/{id}', [ProfilController::class, 'changePassword'])->name('changePassword');
        Route::put('savePassword/{id}', [ProfilController::class, 'savePassword'])->name('savePassword');
    });

    Route::prefix('pengujian')->name('pengujian.')->group(function () {
        Route::get('', [PengujianOrderController::class, 'index'])->name('index');
        Route::get('getOrder/{id}', [PengujianOrderController::class, 'getOrder'])->name('getOrder');
        Route::get('detailOrder/{id}', [PengujianOrderController::class, 'detailOrder'])->name('detailOrder');
        Route::put('editSampel', [PengujianOrderController::class, 'editSampel'])->name('editSampel');
        Route::put('gantiStatus', [PengujianOrderController::class, 'gantiStatus'])->name('gantiStatus');
        Route::get('cetakInvoice/{id}', [PengujianOrderController::class, 'cetakInvoice'])->name('cetakInvoice');
        Route::get('cetakSkr/{id}', [PengujianOrderController::class, 'cetakSkr'])->name('cetakSkr');
        Route::get('cetakTbp/{id}', [PengujianOrderController::class, 'cetakTbp'])->name('cetakTbp');
        Route::get('hasilUji/{order}/sampel/{id}', [PengujianOrderController::class, 'hasilUji'])->name('hasilUji');
        Route::put('updateHasil', [PengujianOrderController::class, 'updateHasil'])->name('updateHasil');
        Route::get('cetakLaporanSementara/{order}/{sampel}', [PengujianOrderController::class, 'cetakLaporanSementara'])->name('cetakLaporanSementara');
        Route::get('cetakSertifikat/{order}/{sampel}', [PengujianOrderController::class, 'cetakSertifikat'])->name('cetakSertifikat');
        Route::get('showBuktiPembayaran/{id}', [PengujianOrderController::class, 'showBuktiPembayaran'])->name('showBuktiPembayaran');
        Route::put('updateBuktiPembayaran/{id}', [PengujianOrderController::class, 'updateBuktiPembayaran'])->name('updateBuktiPembayaran');
        Route::get('editShuPelanggan/{id}', [PengujianOrderController::class, 'editShuPelanggan'])->name('editShuPelanggan');
        Route::put('updateShuPelanggan/{id}', [PengujianOrderController::class, 'updateShuPelanggan'])->name('updateShuPelanggan');
        Route::get('cetakShuPelanggan/{id}', [PengujianOrderController::class, 'cetakShuPelanggan'])->name('cetakShuPelanggan');
    });

    // ==========================================================
    // pengujian selesai admin
    Route::prefix('pengujianSelesai')->name('pengujianSelesai.')->group(function () {
        Route::get('', [PengujianSelesaiOrderController::class, 'index'])->name('index');
        Route::get('getOrder/{id}', [PengujianSelesaiOrderController::class, 'getOrder'])->name('getOrder');
        Route::get('detailOrder/{id}', [PengujianSelesaiOrderController::class, 'detailOrder'])->name('detailOrder');
        Route::put('editSampel', [PengujianSelesaiOrderController::class, 'editSampel'])->name('editSampel');
        Route::put('gantiStatus', [PengujianSelesaiOrderController::class, 'gantiStatus'])->name('gantiStatus');
        Route::get('cetakInvoice/{id}', [PengujianSelesaiOrderController::class, 'cetakInvoice'])->name('cetakInvoice');
        Route::get('cetakSkr/{id}', [PengujianSelesaiOrderController::class, 'cetakSkr'])->name('cetakSkr');
        Route::get('cetakTbp/{id}', [PengujianSelesaiOrderController::class, 'cetakTbp'])->name('cetakTbp');
        Route::get('hasilUji/{order}/sampel/{id}', [PengujianSelesaiOrderController::class, 'hasilUji'])->name('hasilUji');
        Route::put('updateHasil', [PengujianSelesaiOrderController::class, 'updateHasil'])->name('updateHasil');
        Route::get('cetakLaporanSementara/{order}/{sampel}', [PengujianSelesaiOrderController::class, 'cetakLaporanSementara'])->name('cetakLaporanSementara');
        Route::get('cetakSertifikat/{order}/{sampel}', [PengujianSelesaiOrderController::class, 'cetakSertifikat'])->name('cetakSertifikat');
        Route::get('showBuktiPembayaran/{id}', [PengujianSelesaiOrderController::class, 'showBuktiPembayaran'])->name('showBuktiPembayaran');
        Route::put('updateBuktiPembayaran/{id}', [PengujianSelesaiOrderController::class, 'updateBuktiPembayaran'])->name('updateBuktiPembayaran');
        Route::get('editShuPelanggan/{id}', [PengujianSelesaiOrderController::class, 'editShuPelanggan'])->name('editShuPelanggan');
        Route::put('updateShuPelanggan/{id}', [PengujianSelesaiOrderController::class, 'updateShuPelanggan'])->name('updateShuPelanggan');
        Route::get('cetakShuPelanggan/{id}', [PengujianSelesaiOrderController::class, 'cetakShuPelanggan'])->name('cetakShuPelanggan');
    });
    // ==========================================================


    //pengambilan sampel order admin
    Route::prefix('pengambilanSampel')->name('pengambilanSampel.')->group(function () {
        Route::get('', [PengambilanSampelOrderController::class, 'index'])->name('index');
        Route::get('detailOrder/{id}', [PengambilanSampelOrderController::class, 'detailOrder'])->name('detailOrder');
        Route::get('getOrder/{id}', [PengambilanSampelOrderController::class, 'getOrder'])->name('getOrder');
        Route::put('gantiStatus', [PengambilanSampelOrderController::class, 'gantiStatus'])->name('gantiStatus');
        Route::get('cetakInvoice/{id}', [PengambilanSampelOrderController::class, 'cetakInvoice'])->name('cetakInvoice');
        Route::get('cetakSkr/{id}', [PengambilanSampelOrderController::class, 'cetakSkr'])->name('cetakSkr');
        Route::get('cetakTbp/{id}', [PengambilanSampelOrderController::class, 'cetakTbp'])->name('cetakTbp');

        Route::get('showBuktiPembayaran/{id}', [PengambilanSampelOrderController::class, 'showBuktiPembayaran'])->name('showBuktiPembayaran');
        Route::put('updateBuktiPembayaran/{id}', [PengambilanSampelOrderController::class, 'updateBuktiPembayaran'])->name('updateBuktiPembayaran');

        Route::get('beritaAcara/{id}', [PengambilanSampelOrderController::class, 'beritaAcara'])->name('beritaAcara');
        Route::post('storeBeritaAcara', [PengambilanSampelOrderController::class, 'storeBeritaAcara'])->name('storeBeritaAcara');
        Route::put('updateBeritaAcara', [PengambilanSampelOrderController::class, 'updateBeritaAcara'])->name('updateBeritaAcara');
        Route::get('cetakBa/{id}', [PengambilanSampelOrderController::class, 'cetakBa'])->name('cetakBa');
        
        Route::get('editBaPelanggan/{id}', [PengambilanSampelOrderController::class, 'editBaPelanggan'])->name('editBaPelanggan');
        Route::put('updateBaPelanggan/{id}', [PengambilanSampelOrderController::class, 'updateBaPelanggan'])->name('updateBaPelanggan');
        Route::get('cetakBaPelanggan/{id}', [PengambilanSampelOrderController::class, 'cetakBaPelanggan'])->name('cetakBaPelanggan');
    });


    //pengambilan sampel order admin SELESAIIII
    Route::prefix('pengambilanSampelSelesai')->name('pengambilanSampelSelesai.')->group(function () {
        Route::get('', [PengambilanSampelSelesaiController::class, 'index'])->name('index');
        Route::get('detailOrder/{id}', [PengambilanSampelSelesaiController::class, 'detailOrder'])->name('detailOrder');
        Route::get('getOrder/{id}', [PengambilanSampelSelesaiController::class, 'getOrder'])->name('getOrder');
        Route::put('gantiStatus', [PengambilanSampelSelesaiController::class, 'gantiStatus'])->name('gantiStatus');
        Route::get('cetakInvoice/{id}', [PengambilanSampelSelesaiController::class, 'cetakInvoice'])->name('cetakInvoice');
        Route::get('cetakSkr/{id}', [PengambilanSampelSelesaiController::class, 'cetakSkr'])->name('cetakSkr');
        Route::get('cetakTbp/{id}', [PengambilanSampelSelesaiController::class, 'cetakTbp'])->name('cetakTbp');

        Route::get('showBuktiPembayaran/{id}', [PengambilanSampelSelesaiController::class, 'showBuktiPembayaran'])->name('showBuktiPembayaran');
        Route::put('updateBuktiPembayaran/{id}', [PengambilanSampelSelesaiController::class, 'updateBuktiPembayaran'])->name('updateBuktiPembayaran');

        Route::get('beritaAcara/{id}', [PengambilanSampelSelesaiController::class, 'beritaAcara'])->name('beritaAcara');
        Route::post('storeBeritaAcara', [PengambilanSampelSelesaiController::class, 'storeBeritaAcara'])->name('storeBeritaAcara');
        Route::put('updateBeritaAcara', [PengambilanSampelSelesaiController::class, 'updateBeritaAcara'])->name('updateBeritaAcara');
        Route::get('cetakBa/{id}', [PengambilanSampelSelesaiController::class, 'cetakBa'])->name('cetakBa');
        
        Route::get('editBaPelanggan/{id}', [PengambilanSampelSelesaiController::class, 'editBaPelanggan'])->name('editBaPelanggan');
        Route::put('updateBaPelanggan/{id}', [PengambilanSampelSelesaiController::class, 'updateBaPelanggan'])->name('updateBaPelanggan');
        Route::get('cetakBaPelanggan/{id}', [PengambilanSampelSelesaiController::class, 'cetakBaPelanggan'])->name('cetakBaPelanggan');
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
        Route::get('detailOrder/{id}', [PelangganPengujianController::class, 'detailOrder'])->name('detailOrder');
        Route::delete('deleteOrder', [PelangganPengujianController::class, 'deleteOrder'])->name('deleteOrder');
        Route::post('sampel', [PelangganPengujianController::class, 'sampel'])->name('sampel');
        Route::get('getOrder/{id}', [PelangganPengujianController::class, 'getOrder'])->name('getOrder');
        Route::get('getParameter/{id}', [PelangganPengujianController::class, 'getParameter'])->name('getParameter');
         
        Route::get('createSampel/{id}', [PelangganPengujianController::class, 'createSampel'])->name('createSampel');
        Route::post('createSampelParameter', [PelangganPengujianController::class, 'createSampelParameter'])->name('createSampelParameter');
        Route::get('editSampelParameter/{id}', [PelangganPengujianController::class, 'editSampelParameter'])->name('editSampelParameter');
        Route::put('updateSampelParameter/{id}', [PelangganPengujianController::class, 'updateSampelParameter'])->name('updateSampelParameter');
        Route::delete('deleteSampelParameter', [PelangganPengujianController::class, 'deleteSampelParameter'])->name('deleteSampelParameter');

        Route::post('sendOrder', [PelangganPengujianController::class, 'sendOrder'])->name('sendOrder');
        Route::get('tracking/{id}', [PelangganPengujianController::class, 'tracking'])->name('tracking');
        Route::get('showInvoice/{id}', [PelangganPengujianController::class, 'showInvoice'])->name('showInvoice');
        Route::put('buktiPembayaran', [PelangganPengujianController::class, 'buktiPembayaran'])->name('buktiPembayaran');
        Route::get('cetakInvoice/{id}', [PelangganPengujianController::class, 'cetakInvoice'])->name('cetakInvoice');
        Route::get('hasilUji/{order}/sampel/{id}', [PelangganPengujianController::class, 'hasilUji'])->name('hasilUji');

    });

    // ========================================================================

    //pengujian selesai (pelanggan)
    Route::prefix('pengujianSelesai')->name('pengujianSelesai.')->group(function () {
        Route::get('', [PelangganPengujianSelesaiController::class, 'index'])->name('index');
        Route::post('createOrder', [PelangganPengujianSelesaiController::class, 'createOrder'])->name('createOrder');
        Route::get('detailOrder/{id}', [PelangganPengujianSelesaiController::class, 'detailOrder'])->name('detailOrder');
        Route::delete('deleteOrder', [PelangganPengujianSelesaiController::class, 'deleteOrder'])->name('deleteOrder');
        Route::post('sampel', [PelangganPengujianSelesaiController::class, 'sampel'])->name('sampel');
        Route::get('getOrder/{id}', [PelangganPengujianSelesaiController::class, 'getOrder'])->name('getOrder');
        Route::get('getParameter/{id}', [PelangganPengujianSelesaiController::class, 'getParameter'])->name('getParameter');
         
        Route::get('createSampel/{id}', [PelangganPengujianSelesaiController::class, 'createSampel'])->name('createSampel');
        Route::post('createSampelParameter', [PelangganPengujianSelesaiController::class, 'createSampelParameter'])->name('createSampelParameter');
        Route::get('editSampelParameter/{id}', [PelangganPengujianSelesaiController::class, 'editSampelParameter'])->name('editSampelParameter');
        Route::put('updateSampelParameter/{id}', [PelangganPengujianSelesaiController::class, 'updateSampelParameter'])->name('updateSampelParameter');
        Route::delete('deleteSampelParameter', [PelangganPengujianSelesaiController::class, 'deleteSampelParameter'])->name('deleteSampelParameter');

        Route::post('sendOrder', [PelangganPengujianSelesaiController::class, 'sendOrder'])->name('sendOrder');
        Route::get('tracking/{id}', [PelangganPengujianSelesaiController::class, 'tracking'])->name('tracking');
        Route::get('showInvoice/{id}', [PelangganPengujianSelesaiController::class, 'showInvoice'])->name('showInvoice');
        Route::put('buktiPembayaran', [PelangganPengujianSelesaiController::class, 'buktiPembayaran'])->name('buktiPembayaran');
        Route::get('cetakInvoice/{id}', [PelangganPengujianSelesaiController::class, 'cetakInvoice'])->name('cetakInvoice');
        Route::get('hasilUji/{order}/sampel/{id}', [PelangganPengujianSelesaiController::class, 'hasilUji'])->name('hasilUji');
        Route::get('cetakShuPelanggan/{id}', [PelangganPengujianSelesaiController::class, 'cetakShuPelanggan'])->name('cetakShuPelanggan');

    });

    // ========================================================================
    //pengambilan sampel order
    Route::prefix('pengambilanSampel')->name('pengambilanSampel.')->group(function () {
        Route::get('', [PelangganPengambilanSampelController::class, 'index'])->name('index');
        Route::get('createOrder', [PelangganPengambilanSampelController::class, 'createOrder'])->name('createOrder');
        Route::get('detailOrder/{id}', [PelangganPengambilanSampelController::class, 'detailOrder'])->name('detailOrder');
        Route::post('storeOrder', [PelangganPengambilanSampelController::class, 'storeOrder'])->name('storeOrder');
        Route::get('editOrder/{id}', [PelangganPengambilanSampelController::class, 'editOrder'])->name('editOrder');
        Route::put('updateOrder/{id}', [PelangganPengambilanSampelController::class, 'updateOrder'])->name('updateOrder');
        Route::delete('deleteOrder', [PelangganPengambilanSampelController::class, 'deleteOrder'])->name('deleteOrder');

        Route::post('sendOrder', [PelangganPengambilanSampelController::class, 'sendOrder'])->name('sendOrder');
        Route::get('tracking/{id}', [PelangganPengambilanSampelController::class, 'tracking'])->name('tracking');
        Route::get('showInvoice/{id}', [PelangganPengambilanSampelController::class, 'showInvoice'])->name('showInvoice');
        Route::put('buktiPembayaran', [PelangganPengambilanSampelController::class, 'buktiPembayaran'])->name('buktiPembayaran');
        Route::get('cetakInvoice/{id}', [PelangganPengambilanSampelController::class, 'cetakInvoice'])->name('cetakInvoice');
        Route::get('cetakBaPelanggan/{id}', [PelangganPengambilanSampelController::class, 'cetakBaPelanggan'])->name('cetakBaPelanggan');
    });

        // ========================================================================
    //pengambilan sampel selesai Pelanggan
    Route::prefix('pengambilanSampelSelesai')->name('pengambilanSampelSelesai.')->group(function () {
        Route::get('', [PelangganPengambilanSampelSelesaiController::class, 'index'])->name('index');
        Route::get('createOrder', [PelangganPengambilanSampelSelesaiController::class, 'createOrder'])->name('createOrder');
        Route::get('detailOrder/{id}', [PelangganPengambilanSampelSelesaiController::class, 'detailOrder'])->name('detailOrder');
        Route::post('storeOrder', [PelangganPengambilanSampelSelesaiController::class, 'storeOrder'])->name('storeOrder');
        Route::get('editOrder/{id}', [PelangganPengambilanSampelSelesaiController::class, 'editOrder'])->name('editOrder');
        Route::put('updateOrder/{id}', [PelangganPengambilanSampelSelesaiController::class, 'updateOrder'])->name('updateOrder');
        Route::delete('deleteOrder', [PelangganPengambilanSampelSelesaiController::class, 'deleteOrder'])->name('deleteOrder');

        Route::post('sendOrder', [PelangganPengambilanSampelSelesaiController::class, 'sendOrder'])->name('sendOrder');
        Route::get('tracking/{id}', [PelangganPengambilanSampelSelesaiController::class, 'tracking'])->name('tracking');
        Route::get('showInvoice/{id}', [PelangganPengambilanSampelSelesaiController::class, 'showInvoice'])->name('showInvoice');
        Route::put('buktiPembayaran', [PelangganPengambilanSampelSelesaiController::class, 'buktiPembayaran'])->name('buktiPembayaran');
        Route::get('cetakInvoice/{id}', [PelangganPengambilanSampelSelesaiController::class, 'cetakInvoice'])->name('cetakInvoice');
        Route::get('cetakBaPelanggan/{id}', [PelangganPengambilanSampelSelesaiController::class, 'cetakBaPelanggan'])->name('cetakBaPelanggan');
    });

    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('changePassword/{id}', [PelangganProfilController::class, 'changePassword'])->name('changePassword');
        Route::put('savePassword/{id}', [PelangganProfilController::class, 'savePassword'])->name('savePassword');
    });

    Route::prefix('daftarHarga')->name('daftarHarga.')->group(function () {
        Route::get('pengambilanSampel', [PelangganDaftarHargaController::class, 'pengambilanSampel'])->name('pengambilanSampel');
        Route::get('pengujian', [PelangganDaftarHargaController::class, 'pengujian'])->name('pengujian');
    });
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cek-biaya', [App\Http\Controllers\HomeController::class, 'biaya'])->name('biaya');

