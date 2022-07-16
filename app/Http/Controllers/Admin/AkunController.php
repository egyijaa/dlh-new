<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AkunController extends Controller
{
    public function index()
    {
        $admin = User::where('role', '!=', 0)->orderBy('id', 'DESC')->get();
        return view('admin.akun.admin', compact('admin'));
    }
    public function store(Request $request)
    {
        User::create($request->all());
        toast('Data Berhasil Disimpan','success');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $admin = User::find($request->id);
        $admin->update($request->all());
        toast('Data Berhasil Diubah','success');
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        $admin = User::find($request->id);
        $admin->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect()->back();
    }

    //akun pelanggan
    public function pelangganIndex()
    {
        $pelanggan = User::where('role', 0)->orderBy('id', 'DESC')->get();
        return view('admin.akun.pelanggan', compact('pelanggan'));
    }

    public function pelangganVerif(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->aktivasi = $request->get('aktivasi');
        $user->save();

        $email = $user->email;

        $data = array('name' => $user->name);

        if($request->get('aktivasi') == 1)
        {
            Mail::send('admin.akun.mailpelanggan', $data, function ($message) use ($email) {
                $message->from('admin@gmail.com', 'UPT Lab Lingkungan');
                $message->to($email, 'Bapak ibu')->subject('Selamat Akun Anda Sudah Diverifikasi');
            });
            toast('Akun Pelanggan Berhasil di Aktivasi','success');
            return redirect()->back();
        } else {
            
                    toast('Akun Pelanggan Berhasil di Non-Aktifkan','success');
                    return redirect()->back();
        }
    }
    public function pelangganDelete(Request $request)
    {
        $pelanggan = User::find($request->id);
        $pelanggan->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect()->back();
    }

}
