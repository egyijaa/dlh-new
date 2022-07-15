<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SampelUji;

class SampelUjiController extends Controller
{
    public function index()
    {
        $sampel_uji = SampelUji::orderBy('id', 'DESC')->get();
        return view('admin.sampel_uji.index', compact('sampel_uji'));
    }
    public function store(Request $request)
    {
        SampelUji::create($request->all());
        toast('Data Berhasil Disimpan','success');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $sampel_uji = SampelUji::find($request->id);
        $sampel_uji->update($request->all());
        toast('Data Berhasil Diubah','success');
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        $sampel_uji = SampelUji::find($request->id);
        $sampel_uji->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect()->back();
    }
    
}
