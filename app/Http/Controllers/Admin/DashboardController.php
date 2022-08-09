<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengambilanSampelOrder;
use App\Models\PengujianOrder;
use App\Models\User;
use App\Models\SampelOrder;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DashboardController extends Controller
{

    public function index(){
        $pelanggan = User::where('role', 0)->where('aktivasi', 0)->count();
        $pengujian_selesai = PengujianOrder::where('id_status_pengujian', 13)->count();
        $pengambilan_selesai = PengambilanSampelOrder::where('id_status_pengambilan_sampel', 9)->count();
        $pendapatan_pengujian = PengujianOrder::where('id_status_pengujian','>=', 5)->sum('total_harga');
        $pendapatan_pengambilan = PengambilanSampelOrder::where('id_status_pengambilan_sampel','>=', 5)->sum('total_harga');

        $info_bayar_pengujian = PengujianOrder::where('bukti_bayar', '!=', null)->where('id_status_pengujian', 4)->orderBy('id', 'DESC')->limit(20)->get();

        $info_bayar_pengambilan = PengambilanSampelOrder::where('bukti_bayar', '!=', null)->where('id_status_pengambilan_sampel', 4)->orderBy('id', 'DESC')->limit(20)->get();

        $cek_pengujian = PengujianOrder::where('id_status_pengujian', 2)->orderBy('updated_at', 'DESC')->limit(20)->get();
        $cek_pengambilan = PengambilanSampelOrder::where('id_status_pengambilan_sampel', 2)->orderBy('updated_at', 'DESC')->limit(20)->get();

        $sertifikat = SampelOrder::where('foto_shu2', '!=', null)->count();
        $sampel = SampelOrder::count();

        return view('admin.dashboard.index', compact('pelanggan', 'pengujian_selesai', 'pengambilan_selesai', 'pendapatan_pengujian', 'pendapatan_pengambilan', 'info_bayar_pengambilan', 'info_bayar_pengujian', 'cek_pengujian', 'cek_pengambilan', 'sertifikat', 'sampel'));
    }
}
