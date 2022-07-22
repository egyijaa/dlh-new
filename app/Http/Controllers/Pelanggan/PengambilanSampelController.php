<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\ParameterSampel;
use App\Models\ParameterSampelOrder;
use App\Models\PengambilanSampelOrder;
use Illuminate\Http\Request;
use App\Models\PengujianOrder;
use App\Models\SampelOrder;
use App\Models\SampelUji;
use App\Models\StatusPengujian;
use App\Models\TimelinePengambilanSampel;
use App\Models\TimelinePengujian;
use App\Models\TipePelanggan;
use App\Models\VolumeSampel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengambilanSampelController extends Controller
{
    public function index(){
        $pengambilan = PengambilanSampelOrder::where('id_user', auth()->user()->id)->orderBy('id', 'DESC')->get();

        return view('pelanggan.pengambilan_sampel.index', compact('pengambilan'));
    }

    public function createOrder(){
        $tipe_pelanggan = TipePelanggan::all();
        $sampel = SampelUji::all();
        $volume = VolumeSampel::all();

        return view('pelanggan.pengambilan_sampel.create_order', compact('tipe_pelanggan', 'sampel', 'volume'));
    }

    public function generateNoPre(){
        $pengambilan =PengambilanSampelOrder::select('nomor_pre')->latest('id')->first();//cek apakah ada data sbelumnya
        if ($pengambilan) {
            $nomor_pre = $pengambilan->nomor_pre;
            $removed4char = substr($nomor_pre, 5);
            $generateNoPre = $stpad = 'OS-' . str_pad($removed4char + 1, 5, "0", STR_PAD_LEFT);
        } else {
            $generateNoPre = 'OS-' . str_pad(1, 5, "0", STR_PAD_LEFT);
        }
        return $generateNoPre;
    }

    public function storeOrder(Request $request){

        $validatedData = $request->validate([
            'nama_pemesan' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'nik' => 'required',
            'file_surat' => 'mimes:pdf|max:3120',
            'jenis_sampel' =>'required',
            'tanggal_sampling' => 'required',
            'alamat_sampling' => 'required'
        ]);

        $pengambilan = new PengambilanSampelOrder();
        $pengambilan->id_user = auth()->user()->id;
        $pengambilan->id_tipe_pelanggan = $request->get('id_tipe_pelanggan');
        $pengambilan->nomor_pre = $this->generateNoPre();
        $pengambilan->nama_pemesan = $request->get('nama_pemesan');
        $pengambilan->tanggal_isi = $request->get('tanggal_isi');
        $pengambilan->nomor_surat = $request->get('nomor_surat');
        $pengambilan->email = $request->get('email');
        $pengambilan->no_hp = $request->get('no_hp');
        $pengambilan->alamat = $request->get('alamat');
        $pengambilan->keterangan = $request->get('keterangan');
        $pengambilan->nik = $request->get('nik');
        $pengambilan->id_status_pengambilan_sampel = 1;
        $pengambilan->jasa_pelayanan = $request->get('jasa_pelayanan');
        $pengambilan->id_sampel_uji = $request->get('jenis_sampel');
        $pengambilan->tanggal_sampling = $request->get('tanggal_sampling');
        $pengambilan->persyaratan_pelanggan = $request->get('persyaratan_pelanggan');
        $pengambilan->alamat_sampling = $request->get('alamat_sampling');
        $pengambilan->pendamping_sampling = $request->get('pendamping_sampling');
        $pengambilan->jumlah_lokasi_sampling = $request->get('jumlah_lokasi_sampling');
        $pengambilan->jumlah_titik_sampling = $request->get('jumlah_titik_sampling');
        $pengambilan->id_volume_sampel = $request->get('volume_sampel');

        $harga_sampel = SampelUji::where('id', $request->get('jenis_sampel'))->first()->harga;

        $pengambilan->total_harga = $harga_sampel*$request->get('jumlah_titik_sampling');


        if ($request->file('file_surat')) {
            $file = $request->file('file_surat')->store('pengambilan/fileSurat', 'public');
            $pengambilan->file_surat = $file;
        }
        $pengambilan->save();

        $timeline = new TimelinePengambilanSampel();
        $timeline->id_status_pengambilan_sampel = 1;
        $timeline->id_pengambilan_sampel_order = $pengambilan->id;
        $timeline->tanggal = Carbon::now('Asia/Jakarta');
        $timeline->save();

        toast('Data Order Berhasil Disimpan','success');
        return redirect()->back();
    }
}
