<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengambilanSampelOrder;
use App\Models\StatusPengambilanSampel;
use App\Models\Skr;
use App\Models\TimelinePengambilanSampel;
use Carbon\Carbon;
use PDF;

class PengambilanSampelOrderController extends Controller
{
    public function index(){
        $pengambilan = PengambilanSampelOrder::where('id_status_pengambilan_sampel', '!=', 1)->orderBy('id', 'DESC')->get();
        $status = StatusPengambilanSampel::all();

        return view('admin.pengambilan_sampel.index', compact('pengambilan', 'status'));
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
        $pengambilan = PengambilanSampelOrder::find($request->id);
        $pengambilan->id_status_pengambilan_sampel = $request->get('status');
        $pengambilan->save();

        //buat SKR jika orderan diterima
        if($request->status == 4 ){
            //cek apakah udh ada skr sbllumnya udh order pengujian yang sama
            if (Skr::where('id_pengambilan_sampel_order', $request->id)->exists()){

            } else {
                $skr = new Skr();
                $skr->id_pengujian_order = '-';
                $skr->id_pengambilan_sampel_order = $pengambilan->id;
                $skr->no_skr = $this->generateNoSkr();
                $skr->id_skr = $this->generateIdSkr();
                $skr->save();
            }
    
        }

        $timeline = new TimelinePengambilanSampel();
        $timeline->id_status_pengambilan_sampel = $request->get('status');;
        $timeline->id_pengambilan_sampel_order = $pengambilan->id;
        $timeline->tanggal = Carbon::now('Asia/Jakarta');
        $timeline->save();

        toast('Status Berhasil Diubah','success');
        return redirect()->back();
    }

    public function cetakSkr($id){

        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);
        $id_skr = Skr::where('id_pengambilan_sampel_order', $id)->first()->id;
        $skr = Skr::findOrFail($id_skr);
        $pdf = PDF::loadview('admin.pengambilan_sampel.skr', compact('pengambilan_order', 'skr'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }
}
