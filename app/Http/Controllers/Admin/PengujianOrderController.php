<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengujianOrder;
use App\Models\SampelOrder;
use App\Models\StatusPengujian;
use App\Models\TimelinePengujian;
use Carbon\Carbon;
use PDF;

class PengujianOrderController extends Controller
{
    public function index(){
        $pengujian = PengujianOrder::where('id_status_pengujian', '!=', 1)->orderBy('id', 'DESC')->get();
        $status = StatusPengujian::all();

        return view('admin.pengujian_order.index', compact('pengujian', 'status'));
    }

    public function getOrder(Request $request, $id){
        $id_pengujian_order = $id;
        $nomor_pre = PengujianOrder::where('id', $id_pengujian_order)->first()->nomor_pre;

        $sampel_order = SampelOrder::with('parameterSampelOrder')->where('id_pengujian_order', $id_pengujian_order)->orderBy('id', 'DESC')->get();

        return view('admin.pengujian_order.cek_sampel', compact('id_pengujian_order', 'nomor_pre', 'sampel_order'));
    }

    public function gantiStatus(Request $request)
    {
        $pengujian = PengujianOrder::find($request->id);
        $pengujian->id_status_pengujian = $request->get('status');
        $pengujian->save();

        $timeline = new TimelinePengujian();
        $timeline->id_status_pengujian = $request->get('status');;
        $timeline->id_pengujian_order = $pengujian->id;
        $timeline->tanggal = Carbon::now('Asia/Jakarta');
        $timeline->save();

        toast('Status Berhasil Diubah','success');
        return redirect()->back();
    }


    public function cetakLaporanSementara(){
        $pdf = PDF::loadview('admin.pengujian_order.laporan_sementara')->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakSertifikat(){
        $pdf = PDF::loadview('admin.pengujian_order.sertifikat')->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }
}
