<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beranda;

class BerandaController extends Controller
{
    public function index()
    {
        $beranda = Beranda::find(1);
        return view('admin.beranda.index', compact('beranda'));
    }

    public function update(Request $request)
    {
        $beranda = Beranda::find($request->id);
        $beranda->update($request->all());
        toast('Data Berhasil Diubah','success');
        return redirect()->back();
    }
}
