<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\ParameterSampelOrder;
use Illuminate\Http\Request;
use App\Models\PengujianOrder;
use App\Models\SampelOrder;
use App\Models\SampelUji;
use App\Models\ParameterSampel;
use App\Models\Pejabat;
use App\Models\Skr;
use App\Models\StatusPengujian;
use App\Models\Tbp;
use App\Models\TimelinePengujian;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class PengujianOrderController extends Controller
{
    public function index(){
        $pengujian = PengujianOrder::where('id_status_pengujian', '!=', 1)->where('id_status_pengujian', '!=', 13)->orderBy('id', 'DESC')->get();
        $status = StatusPengujian::all();

        return view('bendahara.pengujian_order.index', compact('pengujian', 'status'));
    }

    public function getOrder(Request $request, $id){
        $id_pengujian_order = $id;
        $nomor_pre = PengujianOrder::where('id', $id_pengujian_order)->first()->nomor_pre;
        $status = PengujianOrder::where('id', $id_pengujian_order)->first()->id_status_pengujian;

        $sampel_order = SampelOrder::with('parameterSampelOrder')->where('id_pengujian_order', $id_pengujian_order)->orderBy('id', 'DESC')->get();

        return view('bendahara.pengujian_order.cek_sampel', compact('id_pengujian_order', 'nomor_pre', 'status', 'sampel_order'));
    }

    public function detailOrder($id){
        $id_pengujian_order = $id;
        $pengujian_order = PengujianOrder::findOrFail($id);

        return view('bendahara.pengujian_order.detail_order', compact('id_pengujian_order', 'pengujian_order'));
    }

    public function generateNoUji(){
        $sampel = SampelOrder::select('nomor_uji')->latest('id')->first();//cek apakah ada data sbelumnya
        if ($sampel) {
            $nomor_uji = $sampel->nomor_uji;
            $removed4char = substr($nomor_uji, 5);
            $generateNoUji = $stpad = 'A-' . str_pad($removed4char + 1, 5, "0", STR_PAD_LEFT);
        } else {
            $generateNoUji = 'A-' . str_pad(1, 5, "0", STR_PAD_LEFT);
        }
        return $generateNoUji;
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
        $pengujian = PengujianOrder::find($request->id);
        $pengujian->id_status_pengujian = $request->get('status');
        if ($request->status == 7) {
        $pengujian->tanggal_penyelia = Carbon::now('Asia/Jakarta');
        }
        if ($request->status == 8) {
            $pengujian->tanggal_analis = Carbon::now('Asia/Jakarta');
        }
        $pengujian->save();

        //buat SKR jika orderan diterima
        if($request->status == 4 ){
            //cek apakah udh ada skr sbllumnya utk order pengujian yang sama
            if (Skr::where('id_pengujian_order', $request->id)->exists()){

            } else {
                $skr = new Skr();
                $skr->id_pengujian_order = $pengujian->id;
                $skr->id_pengambilan_sampel_order = '-';
                $skr->no_skr = $this->generateNoSkr();
                $skr->id_skr = $this->generateIdSkr();
                $skr->save();
            }
    
        }

           //buat TBP jika sudah bayar
        if($request->status == 5 ){
            //cek apakah udh ada tbp sbllumnya utk order pengujian yang sama
            if (Tbp::where('id_pengujian_order', $request->id)->exists()){

            } else {
                $tbp = new Tbp();
                $tbp->id_pengujian_order = $pengujian->id;
                $tbp->id_pengambilan_sampel_order = '-';
                $tbp->no_tbp = $this->generateNoTbp();
                $tbp->id_tbp = $this->generateIdTbp();
                $tbp->save();
            }
        }

        $timeline = new TimelinePengujian();
        $timeline->id_status_pengujian = $request->get('status');;
        $timeline->id_pengujian_order = $pengujian->id;
        $timeline->tanggal = Carbon::now('Asia/Jakarta');
        $timeline->id_user = $pengujian->id_user;
        $timeline->keterangan = $request->get('keterangan');
        $timeline->save();

        toast('Status Berhasil Diubah','success');
        return redirect()->back();
    }

    public function cetakInvoice($id){

        $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id);
        $tanggal_buat = TimelinePengujian::where('id_pengujian_order', $id)->where('id_status_pengujian', 4)->latest()->first()->tanggal;
        $pdf = PDF::loadview('bendahara.pengujian_order.invoice', compact('pengujian_order', 'tanggal_buat'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakSkr($id){

        $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id);
        $id_skr = Skr::where('id_pengujian_order', $id)->first()->id;
        $tanggal_skr = TimelinePengujian::where('id_pengujian_order', $id)->where('id_status_pengujian', 4)->latest()->first()->tanggal;
        $skr = Skr::findOrFail($id_skr);
        $kadis = Pejabat::findOrFail(1);
        $pdf = PDF::loadview('bendahara.pengujian_order.skr', compact('pengujian_order', 'skr', 'tanggal_skr', 'kadis'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakTbp($id){
        $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id);
        $id_tbp = Tbp::where('id_pengujian_order', $id)->first()->id;
        $tbp = Tbp::findOrFail($id_tbp);
        $no_skr = Skr::where('id_pengujian_order', $id)->first()->no_skr;
        $bendahara = Pejabat::findOrFail(2);
        $pdf = PDF::loadview('bendahara.pengujian_order.tbp', compact('pengujian_order', 'tbp', 'no_skr', 'bendahara'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function showBuktiPembayaran($id){
        $pengujian = PengujianOrder::findOrFail($id);
        return view('bendahara.pengujian_order.bukti_pembayaran', compact('pengujian'));
    }

    public function updateBuktiPembayaran(Request $request ,$id){

        $pengujian = PengujianOrder::find($id);
        $pengujian->tanggal_bayar = $request->get('tanggal_bayar');

        $pengujian->update();

        toast('Tanggal Pembayaran Berhasil di update','success');
        return redirect()->back();
        
    }
}
