<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengujianOrder;
use App\Models\SampelOrder;
use App\Models\Skr;
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

    public function generateNoSkr(){
   
        $cek_skr = Skr::select('no_skr')->latest('id')->first();
        $year_now = date("Y");
        if($cek_skr){
            $latestSkr = Skr::orderBy('created_at','DESC')->first();
            $generateNoSkr = str_pad($latestSkr->id + 1, 4, "0", STR_PAD_LEFT) . '/SKR/UPT-LAB/DLH/' . $year_now;    
        } else{
            $generateNoSkr = '0001' . '/SKR/UPT-LAB/DLH/' . $year_now;  
        }
   
        return $generateNoSkr;
    }

    public function generateIdSkr(){
   
        $cek_skr = Skr::select('no_skr')->latest('id')->first();
        if($cek_skr){
            $latestSkr = Skr::orderBy('created_at','DESC')->first();
            $generateIdSkr = str_pad($latestSkr->id + 1, 4, "0", STR_PAD_LEFT);    
        } else{
            $generateIdSkr = '0001';  
        }
   
        return $generateIdSkr;
    }

    public function gantiStatus(Request $request)
    {
        $pengujian = PengujianOrder::find($request->id);
        $pengujian->id_status_pengujian = $request->get('status');
        $pengujian->save();

        //buat SKR jika orderan diterima
        if($request->status == 4 ){
            //cek apakah udh ada skr sbllumnya udh order pengujian yang sama
            if (Skr::where('id_pengujian_order', $request->id)->exists()){

            } else {
                $skr = new Skr();
                $skr->id_pengujian_order = $pengujian->id;
                $skr->no_skr = $this->generateNoSkr();
                $skr->id_skr = $this->generateIdSkr();
                $skr->save();
            }
    
        }

        $timeline = new TimelinePengujian();
        $timeline->id_status_pengujian = $request->get('status');;
        $timeline->id_pengujian_order = $pengujian->id;
        $timeline->tanggal = Carbon::now('Asia/Jakarta');
        $timeline->save();

        toast('Status Berhasil Diubah','success');
        return redirect()->back();
    }

    public function cetakSkr($id){

        $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id);
        $id_skr = Skr::where('id_pengujian_order', $id)->first()->id;
        $skr = Skr::findOrFail($id_skr);
        $pdf = PDF::loadview('admin.pengujian_order.skr', compact('pengujian_order', 'skr'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }


    public function cetakLaporanSementara(){
        $pdf = PDF::loadview('admin.pengujian_order.laporan_sementara')->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakSertifikat(){
        $pdf = PDF::loadview('admin.pengujian_order.sertifikat')->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }



    public function cetakTbp(){
        $pdf = PDF::loadview('admin.pengujian_order.tbp')->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }
}
