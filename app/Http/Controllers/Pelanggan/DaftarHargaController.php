<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\ParameterSampel;
use App\Models\SampelUji;
use Illuminate\Http\Request;

class DaftarHargaController extends Controller
{
    public function pengambilanSampel(){
        $pengambilan = SampelUji::all();

        return view('pelanggan.daftar_harga.pengambilan', compact('pengambilan'));
    }

    public function pengujian(){
        $pengujian = SampelUji::with('parameterSampel')->get();

        return view('pelanggan.daftar_harga.pengujian', compact('pengujian'));
    }
}
