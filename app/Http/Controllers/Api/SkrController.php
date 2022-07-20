<?php

namespace App\Http\Controllers\Api;

use App\Models\Skr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SkrResource;
use App\Models\PengujianOrder;

class SkrController extends Controller
{
    public function index()
    {
        //get posts
        $skr = Skr::latest()->paginate(5);

        //return collection of posts as a resource
        return new SkrResource(true, 'List Data Skr', $skr);
    }

    // public function show($id)
    // {
    //     if (Skr::where('id', $id)->exists()) {
    //         $skr = Skr::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
    //         return response($skr, 200);
    //       } else {
    //         return response()->json([
    //           "message" => "SKR not found"
    //         ], 404);
    //       }
    // }

    public function show($id_skr)
    {
        if (Skr::where('id_skr', $id_skr)->exists()) {
            $id_pengujian_order = Skr::where('id_skr', $id_skr)->first()->id_pengujian_order; 
            $no_order = PengujianOrder::where('id', $id_pengujian_order)->first()->nomor_pre;
            $no_skrd = Skr::where('id_skr', $id_skr)->first()->no_skr;
            $tanggal = Skr::where('id_skr', $id_skr)->first()->created_at;
            $tanggal_jatuh_tempo = Skr::where('id_skr', $id_skr)->first()->created_at->add('30 days');
            $kode_opd = '';
            $nik_pemohon = PengujianOrder::where('id', $id_pengujian_order)->first()->nik;
            $nama_pemohon = PengujianOrder::where('id', $id_pengujian_order)->first()->nama_pemesan;
            $alamat_pemohon = PengujianOrder::where('id', $id_pengujian_order)->first()->alamat;
            $email_pemohon = PengujianOrder::where('id', $id_pengujian_order)->first()->email;
            $nilai_pokok = PengujianOrder::where('id', $id_pengujian_order)->first()->total_harga;
            $nilai_denda = '';
            $nilai_total = '';

            $pengujian_order = PengujianOrder::with('sampelOrder')->findOrFail($id_pengujian_order);
            $detail = [];


            // foreach($outerArray as $key => $array) {
            //     foreach($array as $key1 => $value) {
            //        $array[$key1]['sku_id'] = 'XYZ';
            //     }
            //  }

            //  foreach ($pengujian_order as $key => $s){
            //     $detail["sampel"] = $s->sampelUji->nama_sampel;

            //     foreach ($s as $key1 => $parameter){
            //         $detail[$key1]["parameter"] = $parameter->parameterSampel->nama_parameter;
            //         $detail[$key1]["sub_harga"] = $parameter->parameterSampel->harga;

            //     }
            // }

            // foreach ($pengujian_order->sampelOrder as $s){
            //     $detail[]["sampel"] = $s->sampelUji->nama_sampel;

            //     foreach ($s->parameterSampelOrder as $parameter){
            //         $detail[]["parameter"] = $parameter->parameterSampel->nama_parameter;
            //         $detail[]["sub_harga"] = $parameter->parameterSampel->harga;

            //     }
            // }

            foreach ($pengujian_order->sampelOrder as $s){
                foreach ($s->parameterSampelOrder as $parameter){
                $detail[]["sampel"] = $s->sampelUji->nama_sampel;
                $detail[]["parameter"] = $parameter->parameterSampel->nama_parameter;
                $detail[]["sub_harga"] = $parameter->parameterSampel->harga;
                }
            }

            $skr = [
                "no_order" => $no_order, 
                "no_skrd" => $no_skrd,
                "tanggal" => $tanggal,
                "tanggal_jatuh_tempo" => $tanggal_jatuh_tempo,
                "kode_opd" => $kode_opd,
                "nik_pemohon" => $nik_pemohon,
                "nama_pemohon" => $nama_pemohon,
                "alamat_pemohon" => $alamat_pemohon,
                "email_pemohon" => $email_pemohon,
                "kode_rekening" => '4.1.02.02.01.0004',
                "nilai_pokok" => $nilai_pokok,
                "nilai_denda" => 0,
                "nilai_total" => $nilai_pokok,
                "detail" => $detail
            ];
            return new SkrResource(true, 'Data SKR Ditemukan!', $skr);
          } else {
            $skr = [
                "data" => 'Not Found'
            ];
            return new SkrResource(false, 'Data SKR Tidak Ditemukan!', $skr);
          }
    }

}


