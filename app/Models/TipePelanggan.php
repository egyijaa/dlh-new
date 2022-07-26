<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePelanggan extends Model
{
    use HasFactory;

    protected $table = 'tipe_pelanggan';
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class, 'id_tipe_pelanggan', 'id');
    }

    public function pengujianOrder()
    {
        return $this->hasMany(PengujianOrder::class, 'id_tipe_pelanggan', 'id');
    }

    public function pengambilanSampelOrder()
    {
        return $this->hasMany(PengambilanSampelOrder::class, 'id_tipe_pelanggan', 'id');
    }
}
