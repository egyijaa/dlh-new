<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelinePengambilanSampel extends Model
{
    use HasFactory;

    protected $table = 'timeline_pengambilan_sampel';
    protected $guarded = [];

    public function pengambilanSampelOrder()
    {
        return $this->belongsTo(PengambilanSampelOrder::class, 'id_pengambilan_sampel_order', 'id');
    }

    public function statusPengambilanSampel()
    {
        return $this->belongsTo(StatusPengujian::class, 'id_status_pengambilan_sampel', 'id');
    }
}
