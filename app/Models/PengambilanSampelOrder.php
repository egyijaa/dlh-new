<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanSampelOrder extends Model
{
    use HasFactory;

    protected $table = 'pengambilan_sampel_order';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function tipePelanggan()
    {
        return $this->belongsTo(TipePelanggan::class, 'id_tipe_pelanggan', 'id');
    }

    public function sampelUji()
    {
        return $this->belongsTo(SampelUji::class, 'id_sampel_uji', 'id');
    }

    public function volumeSampel()
    {
        return $this->belongsTo(VolumeSampel::class, 'id_pengambilan_sampel_order', 'id');
    }

    public function statusPengambilanSampel()
    {
        return $this->belongsTo(StatusPengujian::class, 'id_status_pengambilan_sampel', 'id');
    }

    public function timelinePengambilanSampel()
    {
        return $this->hasMany(TimelinePengambilanSampel::class, 'id_pengambilan_sampel_order', 'id');
    }

    public function skr()
    {
        return $this->hasOne(Skr::class, 'id_pengambilan_sampel_order', 'id');
    }

    public function tbp()
    {
        return $this->hasOne(Tbp::class, 'id_pengambilan_sampel_order', 'id');
    }
}
