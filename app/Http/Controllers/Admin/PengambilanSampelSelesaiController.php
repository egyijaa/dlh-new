<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeritaAcaraSampel;
use App\Models\Pejabat;
use Illuminate\Http\Request;
use App\Models\PengambilanSampelOrder;
use App\Models\StatusPengambilanSampel;
use App\Models\Skr;
use App\Models\Tbp;
use App\Models\TimelinePengambilanSampel;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;

class PengambilanSampelSelesaiController extends Controller
{
    public function index(){
        $pengambilan = PengambilanSampelOrder::where('id_status_pengambilan_sampel', 9)->orderBy('id', 'DESC')->get();
        $status = StatusPengambilanSampel::all();

        return view('admin.pengambilan_sampel_selesai.index', compact('pengambilan', 'status'));
    }

    public function detailOrder($id){
        $id_pengambilan_sampel_order = $id;
        $pengambilan = PengambilanSampelOrder::findOrFail($id);

        return view('admin.pengambilan_sampel_selesai.detail_order', compact('id_pengambilan_sampel_order', 'pengambilan'));
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
        $timeline->id_status_pengambilan_sampel = $request->get('status');;
        $timeline->id_pengambilan_sampel_order = $pengambilan->id;
        $timeline->tanggal = Carbon::now('Asia/Jakarta');
        $timeline->save();

        toast('Status Berhasil Diubah','success');
        return redirect()->back();
    }

    public function cetakInvoice($id){

        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);
        $tanggal_buat = TimelinePengambilanSampel::where('id_pengambilan_sampel_order', $id)->where('id_status_pengambilan_sampel', 4)->latest()->first()->tanggal;
        $pdf = PDF::loadview('admin.pengambilan_sampel_selesai.invoice', compact('pengambilan_order', 'tanggal_buat'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakSkr($id){

        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);
        $id_skr = Skr::where('id_pengambilan_sampel_order', $id)->first()->id;
        $tanggal_skr = TimelinePengambilanSampel::where('id_pengambilan_sampel_order', $id)->where('id_status_pengambilan_sampel', 4)->latest()->first()->tanggal;
        $skr = Skr::findOrFail($id_skr);
        $kadis = Pejabat::findOrFail(1);
        $pdf = PDF::loadview('admin.pengambilan_sampel_selesai.skr', compact('pengambilan_order', 'skr', 'tanggal_skr', 'kadis'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakTbp($id){
        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);
        $id_tbp = Tbp::where('id_pengambilan_sampel_order', $id)->first()->id;
        $tbp = Tbp::findOrFail($id_tbp);
        $no_skr = Skr::where('id_pengambilan_sampel_order', $id)->first()->no_skr;
        $bendahara = Pejabat::findOrFail(2);
        $pdf = PDF::loadview('admin.pengambilan_sampel_selesai.tbp', compact('pengambilan_order', 'tbp', 'no_skr', 'bendahara'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function showBuktiPembayaran($id){
        $pengambilan = PengambilanSampelOrder::findOrFail($id);
        return view('admin.pengambilan_sampel_selesai.bukti_pembayaran', compact('pengambilan'));
    }

    public function updateBuktiPembayaran(Request $request ,$id){

        $pengambilan = PengambilanSampelOrder::find($id);
        $pengambilan->tanggal_bayar = $request->get('tanggal_bayar');

        $pengambilan->update();

        toast('Tanggal Pembayaran Berhasil di update','success');
        return redirect()->back();
        
    }

    public function beritaAcara($id){
        if (BeritaAcaraSampel::where('id_pengambilan_sampel_order', $id)->exists()) {    
        $pengambilan = PengambilanSampelOrder::findOrFail($id);
        $berita_acara = BeritaAcaraSampel::where('id_pengambilan_sampel_order', $id)->get();
        return view('admin.pengambilan_sampel_selesai.edit_berita_acara', compact('pengambilan', 'berita_acara'));
        } else {
        $pengambilan = PengambilanSampelOrder::findOrFail($id);
        return view('admin.pengambilan_sampel_selesai.create_berita_acara', compact('pengambilan'));
        }     
    }

    public function storeBeritaAcara(Request $request){
        DB::beginTransaction();

        try {
            for($i = 0; $i < count($request->titik_sampling); $i++){
                $berita_acara = new BeritaAcaraSampel();
                $berita_acara->id_pengambilan_sampel_order = $request->id_pengambilan_sampel_order;
                $berita_acara->titik_sampling = $request->titik_sampling[$i];
                $berita_acara->lu = $request->lu[$i];
                $berita_acara->ls = $request->ls[$i];
                $berita_acara->kode_sampel = $request->kode_sampel[$i];
                $berita_acara->suhu = $request->suhu[$i];
                $berita_acara->cuaca = $request->cuaca[$i];
                $berita_acara->foto1 = '-';
                $berita_acara->foto2 = '-';
                $berita_acara->foto3 = '-';
                $berita_acara->save();
            } 
            DB::commit();
            toast('Data Berhasil disimpan')->autoClose(2000)->hideCloseButton();
            return redirect()->route('admin.pengambilanSampelSelesai.index');
        } catch (\Exception $e) {
            DB::rollback();
            toast('Gagal menambah data')->autoClose(2000)->hideCloseButton();
            return redirect()->back();
        }
    }

    public function updateBeritaAcara(Request $request){
        $validatedData = $request->validate([
            'foto1' => 'mimes:JPG,jpeg,png,jpg|max:3048',
            'foto2' => 'mimes:JPG,jpeg,png,jpg|max:3048',
            'foto3' => 'mimes:JPG,jpeg,png,jpg|max:3048',
        ]);

        $berita_acara = BeritaAcaraSampel::findOrFail($request->id);
        $berita_acara->id_pengambilan_sampel_order = $request->id_pengambilan_sampel_order;
        $berita_acara->titik_sampling = $request->titik_sampling;
        $berita_acara->lu = $request->lu;
        $berita_acara->ls = $request->ls;
        $berita_acara->kode_sampel = $request->kode_sampel;
        $berita_acara->suhu = $request->suhu;
        $berita_acara->cuaca = $request->cuaca;

        if ($request->file('foto1')) {
            if ($berita_acara->foto1 && file_exists(storage_path('app/public/' . $berita_acara->foto1))) {
                \Storage::delete('public/' . $berita_acara->foto1);
            }
            $foto1 = $request->file('foto1')->store('pengambilan/foto1', 'public');
            $berita_acara->foto1 = $foto1;
        }

        if ($request->file('foto2')) {
            if ($berita_acara->foto2 && file_exists(storage_path('app/public/' . $berita_acara->foto2))) {
                \Storage::delete('public/' . $berita_acara->foto2);
            }
            $foto2 = $request->file('foto2')->store('pengambilan/foto2', 'public');
            $berita_acara->foto2 = $foto2;
        }

        if ($request->file('foto3')) {
            if ($berita_acara->foto3 && file_exists(storage_path('app/public/' . $berita_acara->foto3))) {
                \Storage::delete('public/' . $berita_acara->foto3);
            }
            $foto3 = $request->file('foto3')->store('pengambilan/foto3', 'public');
            $berita_acara->foto3 = $foto3;
        }

        $berita_acara->update();
        toast('Data Berita Acara Berhasil Diubah','success');
        return redirect()->back();
    }

    public function cetakBa($id){
        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);
        $berita_acara = BeritaAcaraSampel::where('id_pengambilan_sampel_order', $id)->get();
        $teknis = Pejabat::findOrFail(3);
        $penyelia = Pejabat::findOrFail(4);
        $pdf = PDF::loadview('admin.pengambilan_sampel_selesai.ba', compact('pengambilan_order', 'berita_acara', 'teknis', 'penyelia'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function editBaPelanggan($id){
        $pengambilan = PengambilanSampelOrder::findOrFail($id);
        return view('admin.pengambilan_sampel_selesai.edit_ba_pelanggan', compact('pengambilan'));
    }

    public function updateBaPelanggan(Request $request ,$id){
        $validatedData = $request->validate([
            'foto_ba1' => 'mimes:JPG,jpeg,png,jpg|max:2048',
            'foto_ba2' => 'mimes:JPG,jpeg,png,jpg|max:2048',
        ]);

        $pengambilan = PengambilanSampelOrder::find($id);

        if ($request->file('foto_ba1')) {
            if ($pengambilan->foto_ba1 && file_exists(storage_path('app/public/' . $pengambilan->foto_ba1))) {
                \Storage::delete('public/' . $pengambilan->foto_ba1);
            }
            $file = $request->file('foto_ba1')->store('pengambilan/fotoBA1Pelanggan', 'public');
            $pengambilan->foto_ba1 = $file;
        }

        if ($request->file('foto_ba2')) {
            if ($pengambilan->foto_ba2 && file_exists(storage_path('app/public/' . $pengambilan->foto_ba2))) {
                \Storage::delete('public/' . $pengambilan->foto_ba2);
            }
            $file2 = $request->file('foto_ba2')->store('pengambilan/fotoBA2Pelanggan', 'public');
            $pengambilan->foto_ba2 = $file2;
        }

        $pengambilan->update();

        toast('Foto Scan BA Berhasil disimpan','success');
        return redirect()->back();
    }

    public function cetakBaPelanggan($id){
        $pengambilan = PengambilanSampelOrder::findOrFail($id);

        $pdf = PDF::loadview('admin.pengambilan_sampel_selesai.ba_pelanggan', compact('pengambilan'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }
}
