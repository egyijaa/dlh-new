<?php

namespace App\Http\Controllers;

use App\Models\ParameterSampel;
use App\Models\SampelUji;
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
        // if(auth()->user()->role == 1){
            
        //     return view('admin.dashboard.index');
        // } else if (auth()->user()->role == 0){
        //     return view('pelanggan.dashboard.index');
        // }
        return view('frontend.index');


    }

    public function biaya(){
        $parameter = ParameterSampel::all();

        return view('frontend.biaya', compact('parameter'));
    }
}
