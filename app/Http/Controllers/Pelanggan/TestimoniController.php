<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\PengujianOrder;
use App\Models\PengambilanSampelOrder;
use Illuminate\Http\Request;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::where('id_user', auth()->user()->id)->limit(1)->get();

        return view('pelanggan.testimoni.index', compact('testimoni'));
    }
    public function store(Request $request)
    {
        if (PengujianOrder::where('id_user', auth()->user()->id)->where('id_status_pengujian', 13)->exists()) {
            $pengujian = 1;
        } else {
            $pengujian = 0;
        }

        if (PengambilanSampelOrder::where('id_user', auth()->user()->id)->where('id_status_pengambilan_sampel', 9)->exists()) {
            $pengambilan = 1;
        } else {
            $pengambilan = 0;
        }

        if (Testimoni::where('id_user', auth()->user()->id)->exists()) {
            $komentar = 1;
        } else {
            $komentar = 0;
        }

        if ($pengujian == 1 || $pengambilan == 1) {
            if ($komentar == 0) {  
                $testimoni = new Testimoni();
                $testimoni->id_user = auth()->user()->id;
                $testimoni->komentar = $request->get('komentar');
                $testimoni->tampil = '0';
                $testimoni->save();

                toast('Testimoni Berhasil Dibuat. Terimakasih !','success');
                return redirect()->back();
            } else {
                toast('Upss..Testimoni hanya bisa dibuat 1 kali saja','warning');
                return redirect()->back();
            }

        } else {
            toast('Testimoni Bisa dibuat jika sudah menyelesaikan orderan','warning');
            return redirect()->back();
        }


    }
}
