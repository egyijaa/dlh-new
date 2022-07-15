<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengujianOrder;
use App\Models\SampelOrder;

class PengujianOrderController extends Controller
{
    public function index(){
        $pengujian = PengujianOrder::where('id_status_pengujian', '!=', 1)->orderBy('id', 'DESC')->get();

        return view('admin.pengujian_order.index', compact('pengujian'));
    }

    public function getOrder(Request $request, $id){
        $id_pengujian_order = $id;
        $nomor_pre = PengujianOrder::where('id', $id_pengujian_order)->first()->nomor_pre;

        $sampel_order = SampelOrder::with('parameterSampelOrder')->where('id_pengujian_order', $id_pengujian_order)->orderBy('id', 'DESC')->get();

        return view('admin.pengujian_order.cek_sampel', compact('id_pengujian_order', 'nomor_pre', 'sampel_order'));
    }
}
