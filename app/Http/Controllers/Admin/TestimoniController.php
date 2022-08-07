<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::orderBy('id', 'DESC')->get();
        return view('admin.testimoni.index', compact('testimoni'));
    }

    public function update(Request $request)
    {
        $testimoni = Testimoni::find($request->id);
        $testimoni->tampil = $request->get('tampil');
        $testimoni->update();
        toast('Data Berhasil Diubah','success');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $testimoni = Testimoni::find($request->id);
        $testimoni->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect()->back();
    }
}
