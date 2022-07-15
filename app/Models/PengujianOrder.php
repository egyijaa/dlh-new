<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengujianOrder extends Model
{
    use HasFactory;

    protected $table = 'pengujian_order';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function tipePelanggan()
    {
        return $this->belongsTo(TipePelanggan::class, 'id_tipe_pelanggan', 'id');
    }

    public function sampelOrder()
    {
        return $this->hasMany(SampelOrder::class, 'id_pengujian_order', 'id');
    }

    public function statusPengujian()
    {
        return $this->belongsTo(StatusPengujian::class, 'id_status_pengujian', 'id');
    }

    public function timelinePengujian()
    {
        return $this->hasMany(TimelinePengujian::class, 'id_pengujian_order', 'id');
    }

    public function skr()
    {
        return $this->hasOne(Skr::class, 'id_pengujian_order', 'id');
    }

    public function tbp()
    {
        return $this->hasOne(Tbp::class, 'id_pengujian_order', 'id');
    }

}
