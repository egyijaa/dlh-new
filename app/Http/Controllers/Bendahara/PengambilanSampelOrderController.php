<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\BeritaAcaraSampel;
use App\Models\Pejabat;
use Illuminate\Http\Request;
use App\Models\PengambilanSampelOrder;
use App\Models\StatusPengambilanSampel;
use App\Models\Skr;
use App\Models\Tbp;
use App\Models\TimelinePengambilanSampel;
use App\Models\TipePelanggan;
use App\Models\SampelUji;
use App\Models\VolumeSampel;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;

class PengambilanSampelOrderController extends Controller
{
    public function index(){
        $pengambilan = PengambilanSampelOrder::where('id_status_pengambilan_sampel', '!=', 1)->where('id_status_pengambilan_sampel', '!=', 9)->orderBy('id', 'DESC')->get();
        $status = StatusPengambilanSampel::all();

        return view('bendahara.pengambilan_sampel.index', compact('pengambilan', 'status'));
    }

    public function detailOrder($id){
        $id_pengambilan_sampel_order = $id;
        $pengambilan = PengambilanSampelOrder::findOrFail($id);

        return view('bendahara.pengambilan_sampel.detail_order', compact('id_pengambilan_sampel_order', 'pengambilan'));
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

    public function generateNoTbp(){
   
        $cek_tbp = Tbp::select('no_tbp')->latest('id')->first();
        $year_now = date("Y");
        if($cek_tbp){
            $latestTbp = Tbp::orderBy('created_at','DESC')->first();
            $generateNoTbp = str_pad($latestTbp->id + 1, 4, "0", STR_PAD_LEFT) . '/TBP/UPT-LAB/DLH/' . $year_now;    
        } else{
            $generateNoTbp = '0001' . '/TBP/UPT-LAB/DLH/' . $year_now;  
        }
   
        return $generateNoTbp;
    }

    public function generateIdTbp(){
   
        $cek_tbp = Tbp::select('no_tbp')->latest('id')->first();
        if($cek_tbp){
            $latestTbp = Tbp::orderBy('created_at','DESC')->first();
            $generateIdTbp = str_pad($latestTbp->id + 1, 4, "0", STR_PAD_LEFT);    
        } else{
            $generateIdTbp = '0001';  
        }
   
        return $generateIdTbp;
    }

    public function gantiStatus(Request $request)
    {
        $pengambilan = PengambilanSampelOrder::find($request->id);
        $pengambilan->id_status_pengambilan_sampel = $request->get('status');
        $pengambilan->save();

        //buat SKR jika orderan diterima
        if($request->status == 4 ){
            //cek apakah udh ada skr sbllumnya udh order pengambilan sampel yang sama
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

        //buat TBP jika sudah bayar
        if($request->status == 5 ){
            //cek apakah udh ada tbp sbllumnya utk order pengambilan order yang sama
            if (Tbp::where('id_pengambilan_sampel_order', $request->id)->exists()){

            } else {
                $tbp = new Tbp();
                $tbp->id_pengujian_order = '-';
                $tbp->id_pengambilan_sampel_order = $pengambilan->id;
                $tbp->no_tbp = $this->generateNoTbp();
                $tbp->id_tbp = $this->generateIdTbp();
                $tbp->save();
            }
        }

        $timeline = new TimelinePengambilanSampel();
        $timeline->id_status_pengambilan_sampel = $request->get('status');
        $timeline->id_pengambilan_sampel_order = $pengambilan->id;
        $timeline->tanggal = Carbon::now('Asia/Jakarta');
        $timeline->keterangan = $request->get('keterangan');
        $timeline->id_user = $pengambilan->id_user;
        $timeline->save();

        toast('Status Berhasil Diubah','success');
        return redirect()->back();
    }

    public function cetakInvoice($id){

        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);
        $tanggal_buat = TimelinePengambilanSampel::where('id_pengambilan_sampel_order', $id)->where('id_status_pengambilan_sampel', 4)->latest()->first()->tanggal;
        $pdf = PDF::loadview('bendahara.pengambilan_sampel.invoice', compact('pengambilan_order', 'tanggal_buat'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakSkr($id){

        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);
        $id_skr = Skr::where('id_pengambilan_sampel_order', $id)->first()->id;
        $tanggal_skr = TimelinePengambilanSampel::where('id_pengambilan_sampel_order', $id)->where('id_status_pengambilan_sampel', 4)->latest()->first()->tanggal;
        $skr = Skr::findOrFail($id_skr);
        $kadis = Pejabat::findOrFail(1);
        $pdf = PDF::loadview('bendahara.pengambilan_sampel.skr', compact('pengambilan_order', 'skr', 'tanggal_skr', 'kadis'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakTbp($id){
        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);
        $id_tbp = Tbp::where('id_pengambilan_sampel_order', $id)->first()->id;
        $tbp = Tbp::findOrFail($id_tbp);
        $no_skr = Skr::where('id_pengambilan_sampel_order', $id)->first()->no_skr;
        $bendahara = Pejabat::findOrFail(2);
        $pdf = PDF::loadview('bendahara.pengambilan_sampel.tbp', compact('pengambilan_order', 'tbp', 'no_skr', 'bendahara'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function showBuktiPembayaran($id){
        $pengambilan = PengambilanSampelOrder::findOrFail($id);
        return view('bendahara.pengambilan_sampel.bukti_pembayaran', compact('pengambilan'));
    }

    public function updateBuktiPembayaran(Request $request ,$id){

        $pengambilan = PengambilanSampelOrder::find($id);
        $pengambilan->tanggal_bayar = $request->get('tanggal_bayar');

        $pengambilan->update();

        toast('Tanggal Pembayaran Berhasil di update','success');
        return redirect()->back();
        
    }
}
