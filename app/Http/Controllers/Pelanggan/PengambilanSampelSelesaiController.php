<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\PengambilanSampelOrder;
use Illuminate\Http\Request;
use App\Models\SampelUji;
use App\Models\TimelinePengambilanSampel;
use App\Models\TipePelanggan;
use App\Models\VolumeSampel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class PengambilanSampelSelesaiController extends Controller
{
    public function index(){
        $pengambilan = PengambilanSampelOrder::where('id_status_pengambilan_sampel', 9)->where('id_user', auth()->user()->id)->orderBy('id', 'DESC')->get();

        return view('pelanggan.pengambilan_sampel_selesai.index', compact('pengambilan'));
    }

    // public function createOrder(){
    //     $tipe_pelanggan = TipePelanggan::all();
    //     $sampel = SampelUji::all();
    //     $volume = VolumeSampel::all();

    //     return view('pelanggan.pengambilan_sampel_selesai.create_order', compact('tipe_pelanggan', 'sampel', 'volume'));
    // }

    // public function generateNoPre(){
    //     $pengambilan =PengambilanSampelOrder::select('nomor_pre')->latest('id')->first();//cek apakah ada data sbelumnya
    //     if ($pengambilan) {
    //         $nomor_pre = $pengambilan->nomor_pre;
    //         $removed4char = substr($nomor_pre, 5);
    //         $generateNoPre = $stpad = 'OS-' . str_pad($removed4char + 1, 5, "0", STR_PAD_LEFT);
    //     } else {
    //         $generateNoPre = 'OS-' . str_pad(1, 5, "0", STR_PAD_LEFT);
    //     }
    //     return $generateNoPre;
    // }

    // public function storeOrder(Request $request){

    //     $validatedData = $request->validate([
    //         'nama_pemesan' => 'required',
    //         'email' => 'required',
    //         'no_hp' => 'required',
    //         'alamat' => 'required',
    //         'nik' => 'required',
    //         'file_surat' => 'mimes:pdf|max:3120',
    //         'jenis_sampel' =>'required',
    //         'tanggal_sampling' => 'required',
    //         'alamat_sampling' => 'required'
    //     ]);

    //     $year_now = date("Y");

    //     $pengambilan = new PengambilanSampelOrder();
    //     $pengambilan->id_user = auth()->user()->id;
    //     $pengambilan->id_tipe_pelanggan = $request->get('id_tipe_pelanggan');
    //     $pengambilan->nomor_pre = $this->generateNoPre();
    //     $pengambilan->nama_pemesan = $request->get('nama_pemesan');
    //     $pengambilan->tanggal_isi = $request->get('tanggal_isi');
    //     $pengambilan->nomor_surat = $request->get('nomor_surat');
    //     $pengambilan->email = $request->get('email');
    //     $pengambilan->no_hp = $request->get('no_hp');
    //     $pengambilan->alamat = $request->get('alamat');
    //     $pengambilan->keterangan = $request->get('keterangan');
    //     $pengambilan->nik = $request->get('nik');
    //     $pengambilan->id_status_pengambilan_sampel = 1;
    //     $pengambilan->jasa_pelayanan = $request->get('jasa_pelayanan');
    //     $pengambilan->id_sampel_uji = $request->get('jenis_sampel');
    //     $pengambilan->tanggal_sampling = $request->get('tanggal_sampling');
    //     $pengambilan->persyaratan_pelanggan = $request->get('persyaratan_pelanggan');
    //     $pengambilan->alamat_sampling = $request->get('alamat_sampling');
    //     $pengambilan->pendamping_sampling = $request->get('pendamping_sampling');
    //     $pengambilan->jumlah_lokasi_sampling = $request->get('jumlah_lokasi_sampling');
    //     $pengambilan->jumlah_titik_sampling = $request->get('jumlah_titik_sampling');
    //     $pengambilan->id_volume_sampel = $request->get('volume_sampel');
    //     $pengambilan->no_ba = $this->generateNoPre() . '/BAS/' . $year_now;

    //     $harga_sampel = SampelUji::where('id', $request->get('jenis_sampel'))->first()->harga;

    //     $pengambilan->total_harga = $harga_sampel*$request->get('jumlah_titik_sampling');


    //     if ($request->file('file_surat')) {
    //         $file = $request->file('file_surat')->store('pengambilan/fileSurat', 'public');
    //         $pengambilan->file_surat = $file;
    //     }
    //     $pengambilan->save();

    //     $timeline = new TimelinePengambilanSampel();
    //     $timeline->id_status_pengambilan_sampel = 1;
    //     $timeline->id_pengambilan_sampel_order = $pengambilan->id;
    //     $timeline->tanggal = Carbon::now('Asia/Jakarta');
    //     $timeline->save();

    //     toast('Data Order Berhasil Disimpan','success');
    //     return redirect()->route('pelanggan.pengambilanSampelSelesai.index');
    // }

    public function detailOrder($id){
        $pengambilan = PengambilanSampelOrder::findOrFail($id);

        if ($pengambilan->id_user != auth()->user()->id) {
            toast('Uppsss.. akses tidak diizinkan','error');
            return redirect()->route('pelanggan.pengambilanSampelSelesai.index');
        } else {
            return view('pelanggan.pengambilan_sampel_selesai.detail_order', compact('pengambilan'));
        }


    }

    // public function editOrder($id)
    // {
    //     $pengambilan = PengambilanSampelOrder::findOrFail($id);
    //     $tipe_pelanggan = TipePelanggan::all();
    //     $sampel = SampelUji::all();
    //     $volume = VolumeSampel::all();
    //     return view('pelanggan.pengambilan_sampel_selesai.edit_order', compact('pengambilan','tipe_pelanggan', 'sampel', 'volume'));
    // }

    // public function updateOrder(Request $request,$id)
    // {
    //     // dd($request->all());
    //     $validatedData = $request->validate([
    //         'file_surat' => 'mimes:pdf|max:3120',
    //     ]);

    //     $pengambilan = PengambilanSampelOrder::findOrFail($id);

    //     $pengambilan->id_tipe_pelanggan = $request->get('id_tipe_pelanggan');
    //     $pengambilan->nama_pemesan = $request->get('nama_pemesan');
    //     $pengambilan->tanggal_isi = $request->get('tanggal_isi');
    //     $pengambilan->nomor_surat = $request->get('nomor_surat');
    //     $pengambilan->email = $request->get('email');
    //     $pengambilan->no_hp = $request->get('no_hp');
    //     $pengambilan->alamat = $request->get('alamat');
    //     $pengambilan->keterangan = $request->get('keterangan');
    //     $pengambilan->nik = $request->get('nik');
    //     $pengambilan->jasa_pelayanan = $request->get('jasa_pelayanan');
    //     $pengambilan->id_sampel_uji = $request->get('jenis_sampel');
    //     $pengambilan->tanggal_sampling = $request->get('tanggal_sampling');
    //     $pengambilan->persyaratan_pelanggan = $request->get('persyaratan_pelanggan');
    //     $pengambilan->alamat_sampling = $request->get('alamat_sampling');
    //     $pengambilan->pendamping_sampling = $request->get('pendamping_sampling');
    //     $pengambilan->jumlah_lokasi_sampling = $request->get('jumlah_lokasi_sampling');
    //     $pengambilan->jumlah_titik_sampling = $request->get('jumlah_titik_sampling');
    //     $pengambilan->id_volume_sampel = $request->get('volume_sampel');

    //     $harga_sampel = SampelUji::where('id', $request->get('jenis_sampel'))->first()->harga;

    //     $pengambilan->total_harga = $harga_sampel*$request->get('jumlah_titik_sampling');

    //     if ($request->file('file_surat')) {
    //         if ($pengambilan->file_surat && file_exists(storage_path('app/public/' . $pengambilan->file_surat))) {
    //             \Storage::delete('public/' . $pengambilan->file_surat);
    //         }
    //         $fileSurat = $request->file('file_surat')->store('pengambilan/fileSurat', 'public');
    //         $pengambilan->file_surat = $fileSurat;
    //     }

    //     $pengambilan->update();
    //     toast('Data Order Berhasil Diubah','success');
    //     return redirect()->route('pelanggan.pengambilanSampelSelesai.index');

    // }

    // public function deleteOrder(Request $request){
    //     $pengambilan = PengambilanSampelOrder::find($request->id);
    //     $pengambilan->delete();
    //     toast('Order Berhasil Dihapus','success');
    //     return redirect()->back();
    // }

    // public function sendOrder(Request $request){

    //         $timeline = new TimelinePengambilanSampel();
    //         $timeline->id_status_pengambilan_sampel = 2;
    //         $timeline->id_pengambilan_sampel_order = $request->id;
    //         $timeline->tanggal = Carbon::now('Asia/Jakarta');
    //         $timeline->save();

    //         $pengambilan = PengambilanSampelOrder::find($request->id);
    //         $pengambilan->id_status_pengambilan_sampel = 2;
    //         $pengambilan->save();
    
    //         toast('Data Order Berhasil Dikirim, Mohon Menunggu Pengecekan Admin','success');
    //         return redirect()->back();
    // }

    public function tracking(Request $request, $id){

        $timeline = TimelinePengambilanSampel::where('id_pengambilan_sampel_order', $id)->orderBy('id', 'DESC')->get();

        $pengambilan = PengambilanSampelOrder::where('id', $id)->first()->id_user;
        if ($pengambilan != auth()->user()->id) {
            toast('Uppsss...Akses tidak diizinkan','error');
            return redirect()->route('pelanggan.pengambilanSampelSelesai.index');
        } else {
            $nomor_order = PengambilanSampelOrder::where('id', $id)->first()->nomor_pre;

            return view('pelanggan.pengambilan_sampel_selesai.tracking', compact('timeline', 'nomor_order')); 
        }
    }

    public function showInvoice($id){

        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);

        if ($pengambilan_order->id_user != auth()->user()->id) {
            toast('Uppsss.. akses tidak diizinkan','error');
            return redirect()->route('pelanggan.pengambilanSampelSelesai.index');
        } else {
            $tanggal_buat = TimelinePengambilanSampel::where('id_pengambilan_sampel_order', $id)->where('id_status_pengambilan_sampel', 4)->latest()->first()->tanggal;
            return view('pelanggan.pengambilan_sampel_selesai.show_invoice', compact('pengambilan_order', 'tanggal_buat'));
        }
    }

    // public function buktiPembayaran(Request $request){

    //     $validatedData = $request->validate([
    //         'tanggal_bayar' => 'required',
    //         'bukti_bayar' => 'mimes:pdf,JPG,jpeg,png,jpg|max:2048',
    //     ]);

    //     $pengambilan = PengambilanSampelOrder::find($request->id);
    //     $pengambilan->tanggal_bayar = $request->get('tanggal_bayar');

    //     if ($request->file('bukti_bayar')) {
    //         if ($pengambilan->bukti_bayar && file_exists(storage_path('app/public/' . $pengambilan->bukti_bayar))) {
    //             \Storage::delete('public/' . $pengambilan->bukti_bayar);
    //         }
    //         $file = $request->file('bukti_bayar')->store('pengambilan/buktiPembayaran', 'public');
    //         $pengambilan->bukti_bayar = $file;
    //     }

    //     $pengambilan->update();

    //     toast('Bukti Pembayaran Berhasil di Simpan','success');
    //     return redirect()->back();
    // }

    public function cetakInvoice($id){

        $pengambilan_order = PengambilanSampelOrder::findOrFail($id);

        if ($pengambilan_order->id_user != auth()->user()->id) {
            toast('Uppsss.. akses tidak diizinkan','error');
            return redirect()->route('pelanggan.pengambilanSampelSelesai.index');
        } else {
            $tanggal_buat = TimelinePengambilanSampel::where('id_pengambilan_sampel_order', $id)->where('id_status_pengambilan_sampel', 4)->latest()->first()->tanggal;
            $pdf = PDF::loadview('pelanggan.pengambilan_sampel_selesai.invoice', compact('pengambilan_order', 'tanggal_buat'))->setPaper('a4', 'potrait');
            return $pdf->stream();
        }
    }

    public function cetakBaPelanggan($id){
        $pengambilan = PengambilanSampelOrder::findOrFail($id);

        if ($pengambilan->id_user != auth()->user()->id) {
            toast('Uppsss.. akses tidak diizinkan','error');
            return redirect()->route('pelanggan.pengambilanSampelSelesai.index');
        } else {
            $pdf = PDF::loadview('pelanggan.pengambilan_sampel_selesai.ba_pelanggan', compact('pengambilan'))->setPaper('a4', 'potrait');
            return $pdf->stream();
        }
    }
}
