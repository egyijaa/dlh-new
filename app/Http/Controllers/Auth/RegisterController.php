<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('id', 'ASC')->get();
        return view('auth.register', [
            'tipe_pelanggan' => $tipe_pelanggan
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_hp' => ['required', 'numeric', 'digits_between:11,13', 'unique:users'],
            'id_tipe_pelanggan' => ['required'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'role' => 0,
        //     'npwp' => '-',
        //     'alamat' => '-',
        //     'no_hp' => '01231230312',
        //     'aktivasi' => 0,
        //     'keterangan' => '-',
        //     'id_tipe_pelanggan' => 0,
        //     'password' => Hash::make($data['password']),
        // ]);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 0,
            'npwp' => $data['npwp'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'aktivasi' => 0,
            'keterangan' => $data['keterangan'],
            'id_tipe_pelanggan' => $data['id_tipe_pelanggan'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
