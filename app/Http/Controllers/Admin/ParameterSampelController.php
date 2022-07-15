<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParameterSampel;
use App\Models\SampelUji;
use RealRashid\SweetAlert\Facades\Alert;

class ParameterSampelController extends Controller
{
    public function index()
    {
        $parameter_sampel = ParameterSampel::orderBy('id', 'DESC')->get();
        $sampel_uji = SampelUji::all();
        return view('admin.parameter_sampel.index', compact('parameter_sampel', 'sampel_uji'));
    }
    public function store(Request $request)
    {
        ParameterSampel::create($request->all());
        toast('Data Berhasil Disimpan','success');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $parameter_sampel = ParameterSampel::find($request->id);

        $parameter_sampel->id_sampel_uji = $request->get('namasampel');
        $parameter_sampel->nama_parameter = $request->get('namaparameter');
        $parameter_sampel->harga = $request->get('harga');
        $parameter_sampel->save();
        toast('Data Berhasil Diubah','success');
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        $parameter_sampel = ParameterSampel::find($request->id);
        $parameter_sampel->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect()->back();
    }
}
