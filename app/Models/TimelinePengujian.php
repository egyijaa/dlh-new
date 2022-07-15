<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelinePengujian extends Model
{
    use HasFactory;

    protected $table = 'timeline_pengujian';
    protected $guarded = [];

    public function pengujianOrder()
    {
        return $this->belongsTo(PengujianOrder::class, 'id_pengujian_order', 'id');
    }

    public function statusPengujian()
    {
        return $this->belongsTo(StatusPengujian::class, 'id_status_pengujian', 'id');
    }
}
