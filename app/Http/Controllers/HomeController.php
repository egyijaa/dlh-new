<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use App\Models\ParameterSampel;
use App\Models\PengambilanSampelOrder;
use App\Models\PengujianOrder;
use App\Models\SampelOrder;
use App\Models\SampelUji;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $testimoni = Testimoni::where('tampil', 1)->orderBy('id', 'DESC')->get();
        $beranda = Beranda::findOrFail(1);

        $pelanggan = User::where('role', 0)->count();
        $order_pengujian = PengujianOrder::count();
        $order_pengambilan = PengambilanSampelOrder::count();
        $total_order = $order_pengujian + $order_pengambilan;
        $sertifikat_pengujian = SampelOrder::where('foto_shu2', '!=', null)->count();
        $sampel_total = SampelOrder::count();

        return view('frontend.index', compact('testimoni', 'beranda', 'pelanggan', 'total_order', 'sertifikat_pengujian', 'sampel_total'));
    }

    public function biaya(){
        $parameter = ParameterSampel::all();
        $beranda = Beranda::findOrFail(1);

        return view('frontend.biaya', compact('parameter', 'beranda'));
    }

    public function cekSertifikat(Request $request){
        $parameter = ParameterSampel::all();
        $beranda = Beranda::findOrFail(1);

        if (Auth::check()) {
            $pengujian = PengujianOrder::with('sampelOrder')->where('id_user', auth()->user()->id)->where('id_status_pengujian', 13 )->orderBy('id', 'DESC')->get();
            return view('frontend.sertifikat', compact('parameter', 'beranda', 'pengujian'));
        } else {
            return view('frontend.sertifikat', compact('parameter', 'beranda'));
        }
    }
}
