<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_tipe_pelanggan',
        'keterangan',
        'nik',
        'no_hp',
        'aktivasi',
        'role',
        'alamat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tipePelanggan()
    {
        return $this->belongsTo(TipePelanggan::class, 'id_tipe_pelanggan', 'id');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }

    public function pengujianOrder()
    {
        return $this->hasMany(PengujianOrder::class, 'id_user', 'id');
    }

    public function pengambilanSampelOrder()
    {
        return $this->hasMany(PengambilanSampelOrder::class, 'id_user', 'id');
    }

    public function testimoni()
    {
        return $this->hasMany(Testimoni::class, 'id_user', 'id');
    }
}
