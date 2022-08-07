<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\ParameterSampel;
use App\Models\ParameterSampelOrder;
use Illuminate\Http\Request;
use App\Models\PengujianOrder;
use App\Models\SampelOrder;
use App\Models\SampelUji;
use App\Models\StatusPengujian;
use App\Models\TimelinePengujian;
use App\Models\TipePelanggan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class PengujianController extends Controller
{
    public function index(){
        $pengujian = PengujianOrder::with('timelinePengujian')->where('id_user', auth()->user()->id)->where('id_status_pengujian', '!=', 13 )->orderBy('id', 'DESC')->get();
        $tipe_pelanggan = TipePelanggan::all();

        return view('pelanggan.pengujian.index', compact('pengujian', 'tipe_pelanggan'));
    }

    public function generateNoPre(){
        $pengujian =PengujianOrder::select('nomor_pre')->latest('id')->first();//cek apakah ada data sbelumnya
        if ($pengujian) {
            $nomor_pre = $pengujian->nomor_pre;
            $removed4char = substr($nomor_pre, 5);
            $generateNoPre = $stpad = 'OP-' . str_pad($removed4char + 1, 5, "0", STR_PAD_LEFT);
        } else {
            $generateNoPre = 'OP-' . str_pad(1, 5, "0", STR_PAD_LEFT);
        }
        return $generateNoPre;
    }

    public function createOrder(Request $request){
        $validatedData = $request->validate([
            'nama_pemesan' => 'required',
            'email' => 'required',
            'no_hp' => 'required|between:10,13',
            'nik' => 'required|digits:16',
            'alamat' => 'required',
            'file_surat' => 'mimes:pdf|max:3120',
        ]);

        $pengujian = new PengujianOrder();
        $pengujian->id_user = auth()->user()->id;
        $pengujian->id_tipe_pelanggan = $request->get('id_tipe_pelanggan');
        $pengujian->nomor_pre = $this->generateNoPre();
        $pengujian->nama_pemesan = $request->get('nama_pemesan');
        $pengujian->tanggal_isi = $request->get('tanggal_isi');
        $pengujian->nomor_surat = $request->get('nomor_surat');
        $pengujian->email = $request->get('email');
        $pengujian->no_hp = $request->get('no_hp');
        $pengujian->alamat = $request->get('alamat');
        $pengujian->keterangan = $request->get('keterangan');
        $pengujian->nik = $request->get('nik');
        $pengujian->id_status_pengujian = 1;


        if ($request->file('file_surat')) {
            $file = $request->file('file_surat')->store('pengujian/fileSurat', 'public');
            $pengujian->file_surat = $file;
        }
        $pengujian->save();

        $timeline = new TimelinePengujian();
        $timeline->id_status_pengujian = 1;
        $timeline->id_pengujian_order = $pengujian->id;
        $timeline->tanggal = Carbon::now('Asia/Jakarta');
        $timeline->id_user = auth()->user()->id;
        $timeline->save();

        toast('Data Order Berhasil Disimpan','success');
        return redirect()->back();

    }

    public function detailOrder($id){
        $id_pengujian_order = $id;
        $pengujian_order = PengujianOrder::findOrFail($id);

        return view('pelanggan.pengujian.detail_order', compact('id_pengujian_order', 'pengujian_order'));
    }

    public function deleteOrder(Request $request)
    {
        $order = PengujianOrder::find($request->id);
        $order->delete();
        toast('Data Order Berhasil Dihapus','success');
        return redirect()->back();
    }

    public function sampel(Request $request){
        $id_order = $request->get('id_order');
        return Redirect::route('pelanggan.pengujian.getOrder', $id_order);
    }

    public function getOrder(Request $request, $id){
        $id_pengujian_order = $id;
        $pengujian = PengujianOrder::findOrFail($id);
        if ($pengujian->id_user != auth()->user()->id) {
            toast('Eitsss...Anda tidak boleh masuk ke orderan orang lain!','error');
            return Redirect::route('pelanggan.pengujian.index');
        } else {
            $nomor_pre = PengujianOrder::where('id', $id_pengujian_order)->first()->nomor_pre;

            $status = PengujianOrder::where('id', $id_pengujian_order)->first()->id_status_pengujian;
    
            $sampel = SampelUji::all();
    
            $sampel_order = SampelOrder::with('parameterSampelOrder')->where('id_pengujian_order', $id_pengujian_order)->orderBy('id', 'DESC')->get();
    
            return view('pelanggan.pengujian.sampel', compact('id_pengujian_order', 'nomor_pre', 'sampel', 'status', 'sampel_order'));
        }
     
    }

    public function getParameter(Request $request, $id)
    {
        $parameters = ParameterSampel::where("id_sampel_uji",$id)->get();
        return response()->json([
            'message' => 'success',
            'data' => $parameters
        ]);
    }

    public function createSampel($id){
        $id_pengujian_order = $id;
        $nomor_pre = PengujianOrder::where('id', $id_pengujian_order)->first()->nomor_pre;

        $sampel = SampelUji::all();
        return view('pelanggan.pengujian.create_sampel', compact('id_pengujian_order','nomor_pre','sampel'));
    }

    // public function generateNoUji(){
    //     $sampel = SampelOrder::select('nomor_uji')->latest('id')->first();//cek apakah ada data sbelumnya
    //     if ($sampel) {
    //         $latestNoUji = SampelOrder::orderBy('created_at','DESC')->first();
    //         $generateNoUji =  'A-' . str_pad($latestNoUji->id + 1, 4, "0", STR_PAD_LEFT);  
    //     } else {
    //         $generateNoUji = 'A-' . '00001';
    //     }
    //     return $generateNoUji;
    // }

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

    public function createSampelParameter(Request $request){
        DB::beginTransaction();
        $validatedData = $request->validate([
            'id_pengujian_order' => 'required',
            'kode_sampel' => 'required',
            'asal_sampel' => 'required',
        ]);

        $year_now = date("Y");
        try {
            $sampel_order = SampelOrder::create([
                'id_pengujian_order' =>  $request->id_pengujian_order,
                'id_sampel_uji' =>  $request->sampel,
                'kode_sampel' =>  $request->kode_sampel,
                'asal_sampel' =>  $request->asal_sampel,
                'catatan_pelanggan' => $request->catatan_pelanggan,
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
            //coba tambahkan total di SampelOrder
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
            toast('Data Sampel dan Parameter Berhasil Disimpan','success');
            return Redirect::route('pelanggan.pengujian.getOrder', $request->id_pengujian_order);
        } catch (\Exception $e) {
            DB::rollback();
            toast('Gagal menambah data')->autoClose(2000)->hideCloseButton();
            return redirect()->back();
        }
    }

    public function editSampelParameter($id)
    {
        $sampel_order = SampelOrder::with('parameterSampelOrder')->findOrFail($id);
        $id_pengujian_order = $sampel_order->id_pengujian_order;
        $pengujian = PengujianOrder::findOrFail($id_pengujian_order);

        if ($pengujian->id_user != auth()->user()->id) {
            toast('Eitsss...Anda tidak boleh masuk ke orderan orang lain!','error');
            return Redirect::route('pelanggan.pengujian.index');
        } else {
            $sampel = SampelUji::all();
            return view('pelanggan.pengujian.edit_sampel', [
                'sampel_order' => $sampel_order,
                'sampel' => $sampel
            ]);
        }
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
            return view('pelanggan.pengujian.sampel', compact('id_pengujian_order', 'nomor_pre', 'sampel', 'status', 'sampel_order'));
        } catch (\Exception $e) {
            DB::rollback();
            toast('Gagal mengubah data')->autoClose(2000)->hideCloseButton();
            return redirect()->back();
        }
    }

    public function deleteSampelParameter(Request $request)
    {
        $sampel_order = SampelOrder::find($request->id);
        $id_pengujian = $sampel_order->id_pengujian_order;
        $sampel_order->delete();

        if (SampelOrder::where('id_pengujian_order', $id_pengujian)->exists()) { 
            toast('Data Berhasil Dihapus','success');
            return redirect()->back();
        } else {
            toast('Data Berhasil Dihapus','success');
            return Redirect::route('pelanggan.pengujian.index');
        }
      
    }

    public function sendOrder(Request $request){

        $sampel_order = SampelOrder::where('id_pengujian_order', $request->id)->first();
        if($sampel_order){
            $timeline = new TimelinePengujian();
            $timeline->id_status_pengujian = 2;
            $timeline->id_pengujian_order = $request->id;
            $timeline->tanggal = Carbon::now('Asia/Jakarta');
            $timeline->id_user = auth()->user()->id;
            $timeline->save();

            $order = PengujianOrder::find($request->id);
            $order->id_status_pengujian = 2;
            $order->save();
    
            toast('Data Order Berhasil Dikirim, Mohon Menunggu Pengecekan Admin','success');
            return redirect()->back();
        }else{
            toast('Gagal ! Data Order Belum Memiliki Sampel','error');
            return redirect()->back();
        }
    }

    public function tracking(Request $request, $id){

        $timeline = TimelinePengujian::where('id_pengujian_order', $id)->orderBy('id', 'DESC')->get();
    
        $nomor_order = PengujianOrder::where('id', $id)->first()->nomor_pre;

        return view('pelanggan.pengujian.tracking', compact('timeline', 'nomor_order'));
    }

    public function showInvoice($id){

        $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id);
        $tanggal_buat = TimelinePengujian::where('id_pengujian_order', $id)->where('id_status_pengujian', 4)->latest()->first()->tanggal;
        return view('pelanggan.pengujian.show_invoice', compact('pengujian_order', 'tanggal_buat'));
    }

    public function buktiPembayaran(Request $request){

        $validatedData = $request->validate([
            'tanggal_bayar' => 'required',
            'bukti_bayar' => 'mimes:pdf,JPG,jpeg,png,jpg|max:3120',
        ]);

        $pengujian = PengujianOrder::find($request->id);
        $pengujian->tanggal_bayar = $request->get('tanggal_bayar');

        if ($request->file('bukti_bayar')) {
            if ($pengujian->bukti_bayar && file_exists(storage_path('app/public/' . $pengujian->bukti_bayar))) {
                \Storage::delete('public/' . $pengujian->bukti_bayar);
            }
            $file = $request->file('bukti_bayar')->store('pengujian/buktiPembayaran', 'public');
            $pengujian->bukti_bayar = $file;
        }

        $pengujian->update();

        toast('Bukti Pembayaran Berhasil di Simpan','success');
        return redirect()->back();
    }

    public function cetakInvoice($id){

        $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id);
        $tanggal_buat = TimelinePengujian::where('id_pengujian_order', $id)->where('id_status_pengujian', 4)->latest()->first()->tanggal;
        $pdf = PDF::loadview('pelanggan.pengujian.invoice', compact('pengujian_order', 'tanggal_buat'))->setPaper('a4', 'potrait');
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

        return view('pelanggan.pengujian.hasil_uji', compact('parameter_order', 'nomor_order', 'nama_sampel', 'kode_sampel', 'id_pengujian_order', 'id_sampel_order'));
    }


}