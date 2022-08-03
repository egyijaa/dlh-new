<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\PengujianOrder;
use App\Http\Controllers\Controller;
use App\Models\PengambilanSampelOrder;
use App\Models\TimelinePengambilanSampel;
use App\Models\TimelinePengujian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $pengujian_baru = PengujianOrder::where('id_user', auth()->user()->id)->where('id_status_pengujian', '!=', 13)->count();

        $pengujian_selesai = PengujianOrder::where('id_user', auth()->user()->id)->where('id_status_pengujian', 13)->count();

        $pengujian_belum_bayar = PengujianOrder::where('id_user', auth()->user()->id)->where('id_status_pengujian', 4)->count();

        $pengambilan_baru = PengambilanSampelOrder::where('id_user', auth()->user()->id)->where('id_status_pengambilan_sampel', '!=', 9)->count();

        $pengambilan_selesai = PengambilanSampelOrder::where('id_user', auth()->user()->id)->where('id_status_pengambilan_sampel', 9)->count();

        $pengambilan_belum_bayar = PengambilanSampelOrder::where('id_user', auth()->user()->id)->where('id_status_pengambilan_sampel', 4)->count();

        $timeline_pengambilan = TimelinePengambilanSampel::where('id_user', auth()->user()->id)->orderBy('id', 'DESC')->paginate(7);

        $timeline_pengujian = TimelinePengujian::where('id_user', auth()->user()->id)->orderBy('id', 'DESC')->paginate(7);

        return view('pelanggan.dashboard.index', compact('pengujian_baru', 'pengujian_selesai', 'pengujian_belum_bayar', 'pengambilan_baru', 'pengambilan_selesai', 'pengambilan_belum_bayar', 'timeline_pengambilan', 'timeline_pengujian'));
    }
}
