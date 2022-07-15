<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $pelanggan = User::where('role', 0)->where('aktivasi', 0)->count();
        
        return view('admin.dashboard.index', compact('pelanggan'));
    }
}
