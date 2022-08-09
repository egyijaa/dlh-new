<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.pengujian_order.index', compact('pengujian', 'status'));
    }

    public function getOrder(Request $request, $id){
        $id_pengujian_order = $id;
        $nomor_pre = PengujianOrder::where('id', $id_pengujian_order)->first()->nomor_pre;
        $status = PengujianOrder::where('id', $id_pengujian_order)->first()->id_status_pengujian;

        $sampel_order = SampelOrder::with('parameterSampelOrder')->where('id_pengujian_order', $id_pengujian_order)->orderBy('id', 'DESC')->get();

        return view('admin.pengujian_order.cek_sampel', compact('id_pengujian_order', 'nomor_pre', 'status', 'sampel_order'));
    }

    public function detailOrder($id){
        $id_pengujian_order = $id;
        $pengujian_order = PengujianOrder::findOrFail($id);

        return view('admin.pengujian_order.detail_order', compact('id_pengujian_order', 'pengujian_order'));
    }

    public function editSampel(Request $request){
        $sampel = SampelOrder::find($request->id);
        $sampel->diambil_dari = $request->get('diambil_dari');
  
        $sampel->update();
        toast('Data Berhasil Diubah','success');
        return redirect()->back();
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

    public function editSampelParameter($id)
    {
        $sampel_order = SampelOrder::with('parameterSampelOrder')->findOrFail($id);
        $sampel = SampelUji::all();
        return view('admin.pengujian_order.edit_sampel', [
                'sampel_order' => $sampel_order,
                'sampel' => $sampel
            ]);
    }

    public function updateSampelParameter(Request $request)
    {
        DB::beginTransaction();
        $validatedData = $request->validate([
            'id_pengujian_order' => 'required',
            'kode_sampel' => 'required',
            'asal_sampel' => 'required',
        ]);

        try {
      
            $sampel_order_old = SampelOrder::find($request->id_sampel_order);
            $sampel_order_old->delete();

            $year_now = date("Y");
            $sampel_order = SampelOrder::create([
                'id_pengujian_order' =>  $request->id_pengujian_order,
                'id_sampel_uji' =>  $request->sampel,
                'kode_sampel' =>  $request->kode_sampel,
                'asal_sampel' =>  $request->asal_sampel,
                'catatan_pelanggan' =>  $request->catatan_pelanggan,
                'nomor_uji' => $this->generateNoUji(),
                'nomor_sertifikat' => $this->generateNoUji() . '/SHU/LABLING/' . $year_now,
                'harga' => ''
                
            ]);
            $total = [];
            for($i = 0; $i < count($request->parameter); $i++){
                $harga_parameter = ParameterSampel::where('id', $request->parameter[$i])->first()->harga;
                ParameterSampelOrder::create([
                    'id_sampel_order' => $sampel_order->id,
                    'id_parameter_sampel' => $request->parameter[$i],
                ]);
                $total[] = $harga_parameter;
            } 
            //coba tambahkan total di sampelorder
            $totalFinal = array_sum($total);
            $s = SampelOrder::find($sampel_order->id);
            $s->harga = $totalFinal;
            $s->save();

            //sub total biaya dimasukkan ke pengujian order
            $total_harga = SampelOrder::where('id_pengujian_order', $request->id_pengujian_order)->sum('harga');
            $pengujian_order = PengujianOrder::find($request->id_pengujian_order);
            $pengujian_order->total_harga = $total_harga;
            $pengujian_order->save();
            DB::commit();

            //return ke halaman sampel dgn mengembalikan paramereter seperti di function getOrder
            $id_pengujian_order = $request->id_pengujian_order;
            $nomor_pre = PengujianOrder::where('id', $id_pengujian_order)->first()->nomor_pre;
    
            $status = PengujianOrder::where('id', $id_pengujian_order)->first()->id_status_pengujian;
    
            $sampel = SampelUji::all();
    
            $sampel_order = SampelOrder::with('parameterSampelOrder')->where('id_pengujian_order', $id_pengujian_order)->orderBy('kode_sampel', 'DESC')->get();
    
            toast('Data Sampel dan Parameter Berhasil Diubah','success');
            return redirect()->route('admin.pengujian.getOrder', $id_pengujian_order);
        } catch (\Exception $e) {
            DB::rollback();
            toast('Gagal mengubah data')->autoClose(2000)->hideCloseButton();
            return redirect()->back();
        }
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
        $pdf = PDF::loadview('admin.pengujian_order.invoice', compact('pengujian_order', 'tanggal_buat'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakSkr($id){

        $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id);
        $id_skr = Skr::where('id_pengujian_order', $id)->first()->id;
        $tanggal_skr = TimelinePengujian::where('id_pengujian_order', $id)->where('id_status_pengujian', 4)->latest()->first()->tanggal;
        $skr = Skr::findOrFail($id_skr);
        $kadis = Pejabat::findOrFail(1);
        $pdf = PDF::loadview('admin.pengujian_order.skr', compact('pengujian_order', 'skr', 'tanggal_skr', 'kadis'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakTbp($id){
        $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id);
        $id_tbp = Tbp::where('id_pengujian_order', $id)->first()->id;
        $tbp = Tbp::findOrFail($id_tbp);
        $no_skr = Skr::where('id_pengujian_order', $id)->first()->no_skr;
        $bendahara = Pejabat::findOrFail(2);
        $pdf = PDF::loadview('admin.pengujian_order.tbp', compact('pengujian_order', 'tbp', 'no_skr', 'bendahara'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function hasilUji($order ,$id){
        $parameter_order = ParameterSampelOrder::where('id_sampel_order', $id)->get();
        $nomor_order = $order;
        $id_sampel_order = $id;
        $sampel = SampelOrder::where('id', $id)->first()->id_sampel_uji;
        $kode_sampel = SampelOrder::where('id', $id)->first()->kode_sampel;
        $nama_sampel = SampelUji::where('id', $sampel)->first()->nama_sampel;
        $id_pengujian_order = SampelOrder::where('id', $id)->first()->id_pengujian_order;

        return view('admin.pengujian_order.hasil_uji', compact('parameter_order', 'nomor_order', 'nama_sampel', 'kode_sampel', 'id_pengujian_order', 'id_sampel_order'));
    }

    public function updateHasil(Request $request){
        $parameter_order = ParameterSampelOrder::find($request->id);

        $parameter_order->metode_uji = $request->get('metode_uji');
        $parameter_order->satuan = $request->get('satuan');
        $parameter_order->hasil_pengujian = $request->get('hasil_pengujian');
        $parameter_order->baku_mutu = $request->get('baku_mutu');
        $parameter_order->update();
        toast('Data Berhasil Dibuat','success');
        return redirect()->back();
    }

    public function cetakLaporanSementara($order, $sampel){
        $id_order_pengujian = $order;
        $id_sampel_order = $sampel;
        $tanggal_diterima_sampel = TimelinePengujian::where('id_pengujian_order', $id_order_pengujian)->where('id_status_pengujian', 6)->latest()->first()->tanggal;
        $sampel_order = SampelOrder::with('parameterSampelOrder')->findOrFail($id_sampel_order);
        $teknis = Pejabat::findOrFail(3);
        $penyelia = Pejabat::findOrFail(4);

        $pdf = PDF::loadview('admin.pengujian_order.laporan_sementara', compact('sampel_order', 'tanggal_diterima_sampel', 'teknis', 'penyelia'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function cetakSertifikat($order, $sampel){
        $id_order_pengujian = $order;
        $id_sampel_order = $sampel;

        $sampel_order = SampelOrder::with('parameterSampelOrder')->findOrFail($id_sampel_order);

        $tanggal_diterima_sampel = TimelinePengujian::where('id_pengujian_order', $id_order_pengujian)->where('id_status_pengujian', 6)->latest()->first()->tanggal;
        $tanggal_terbit_shu = TimelinePengujian::where('id_pengujian_order', $id_order_pengujian)->where('id_status_pengujian', 11)->latest()->first()->tanggal;

        $tanggal_selesai_analisis =  TimelinePengujian::where('id_pengujian_order', $id_order_pengujian)->where('id_status_pengujian', 9)->latest()->first()->tanggal;
        $teknis = Pejabat::findOrFail(3);
        $pdf = PDF::loadview('admin.pengujian_order.sertifikat', compact('sampel_order', 'tanggal_diterima_sampel', 'tanggal_terbit_shu', 'tanggal_selesai_analisis', 'teknis'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function showBuktiPembayaran($id){
        $pengujian = PengujianOrder::findOrFail($id);
        return view('admin.pengujian_order.bukti_pembayaran', compact('pengujian'));
    }

    public function updateBuktiPembayaran(Request $request ,$id){

        $pengujian = PengujianOrder::find($id);
        $pengujian->tanggal_bayar = $request->get('tanggal_bayar');

        $pengujian->update();

        toast('Tanggal Pembayaran Berhasil di update','success');
        return redirect()->back();
        
    }

    public function editShuPelanggan($id){
        $sampel = SampelOrder::findOrFail($id);
        return view('admin.pengujian_order.edit_shu_pelanggan', compact('sampel'));
    }

    public function updateShuPelanggan(Request $request ,$id){
        $validatedData = $request->validate([
            'foto_shu1' => 'mimes:JPG,jpeg,png,jpg|max:3120',
            'foto_shu2' => 'mimes:JPG,jpeg,png,jpg|max:5120',
        ]);

        $sampel = SampelOrder::find($id);

        if ($request->file('foto_shu1')) {
            if ($sampel->foto_shu1 && file_exists(storage_path('app/public/' . $sampel->foto_shu1))) {
                \Storage::delete('public/' . $sampel->foto_shu1);
            }
            $file = $request->file('foto_shu1')->store('pengujian/fotoSHU1Pelanggan', 'public');
            $sampel->foto_shu1 = $file;
        }

        if ($request->file('foto_shu2')) {
            if ($sampel->foto_shu2 && file_exists(storage_path('app/public/' . $sampel->foto_shu2))) {
                \Storage::delete('public/' . $sampel->foto_shu2);
            }
            $file2 = $request->file('foto_shu2')->store('pengujian/fotoSHU2Pelanggan', 'public');
            $sampel->foto_shu2 = $file2;
        }

        $sampel->update();

        toast('Foto Scan SHU Berhasil disimpan','success');
        return redirect()->back();
    }


    public function cetakShuPelanggan($id){
        $sampel_order = SampelOrder::findOrFail($id);

        $pdf = PDF::loadview('admin.pengujian_order.sertifikat_pelanggan', compact('sampel_order'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }




 
}
