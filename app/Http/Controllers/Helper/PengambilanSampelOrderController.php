<?php

namespace App\Http\Controllers\Helper;

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

        return view('helper.pengambilan_sampel.index', compact('pengambilan', 'status'));
    }

    public function detailOrder($id){
        $id_pengambilan_sampel_order = $id;
        $pengambilan = PengambilanSampelOrder::findOrFail($id);

        return view('helper.pengambilan_sampel.detail_order', compact('id_pengambilan_sampel_order', 'pengambilan'));
    }

    public function beritaAcara($id){
        if (BeritaAcaraSampel::where('id_pengambilan_sampel_order', $id)->exists()) {    
        $pengambilan = PengambilanSampelOrder::findOrFail($id);
        $berita_acara = BeritaAcaraSampel::where('id_pengambilan_sampel_order', $id)->get();
        return view('helper.pengambilan_sampel.edit_berita_acara', compact('pengambilan', 'berita_acara'));
        } else {
        $pengambilan = PengambilanSampelOrder::findOrFail($id);
        return view('helper.pengambilan_sampel.create_berita_acara', compact('pengambilan'));
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
            return redirect()->route('helper.pengambilanSampel.index');
        } catch (\Exception $e) {
            DB::rollback();
            toast('Gagal menambah data')->autoClose(2000)->hideCloseButton();
            return redirect()->back();
        }
    }

    public function updateBeritaAcara(Request $request){
        $validatedData = $request->validate([
            'foto1' => 'mimes:JPG,jpeg,png,jpg|max:3120',
            'foto2' => 'mimes:JPG,jpeg,png,jpg|max:3120',
            'foto3' => 'mimes:JPG,jpeg,png,jpg|max:3120',
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

        $pdf = PDF::loadview('helper.pengambilan_sampel.ba', compact('pengambilan_order', 'berita_acara', 'teknis', 'penyelia'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }

    public function editBaPelanggan($id){
        $pengambilan = PengambilanSampelOrder::findOrFail($id);
        return view('helper.pengambilan_sampel.edit_ba_pelanggan', compact('pengambilan'));
    }

    public function updateBaPelanggan(Request $request ,$id){
        $validatedData = $request->validate([
            'foto_ba1' => 'mimes:JPG,jpeg,png,jpg|max:3120',
            'foto_ba2' => 'mimes:JPG,jpeg,png,jpg|max:5120',
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

        $pdf = PDF::loadview('helper.pengambilan_sampel.ba_pelanggan', compact('pengambilan'))->setPaper('a4', 'potrait');
	    return $pdf->stream();
    }
}
