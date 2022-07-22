<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DashboardController extends Controller
{

    public function index(){
        $pelanggan = User::where('role', 0)->where('aktivasi', 0)->count();
        
        return view('admin.dashboard.index', compact('pelanggan'));
    }

    public function apiWithoutKey()
    {
        $client = new Client(); //GuzzleHttp\Client
        // $url = "https://api.github.com/users/kingsconsult/repos";
        $id = '0001';

        $url = "http://polis.masuk.web.id/api/dlh/meowmeow/skr/" . $id;
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());
        // dd($responseBody->data->tanggal);
        // $responseBody = json_decode($response, true);

        return view('admin.apiwithoutkey', compact('responseBody'));
    }
}
