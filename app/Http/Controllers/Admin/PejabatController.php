<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pejabat;

class PejabatController extends Controller
{

    public function index()
    {
        $pejabat = Pejabat::orderBy('id', 'DESC')->get();
        return view('admin.pejabat.index', compact('pejabat'));
    }

    public function update(Request $request)
    {
        $pejabat = Pejabat::find($request->id);
        $pejabat->update($request->all());
        toast('Data Berhasil Diubah','success');
        return redirect()->back();
    }
}
