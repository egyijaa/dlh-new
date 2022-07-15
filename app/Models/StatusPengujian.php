<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengujian extends Model
{
    use HasFactory;

    protected $table = 'status_pengujian';
    protected $guarded = [];

    public function timelinePengujian()
    {
        return $this->hasMany(TimelinePengujian::class, 'id_status_pengujian', 'id');
    }

    public function pengujianOrder()
    {
        return $this->hasOne(PengujianOrder::class, 'id_status_pengujian', 'id');
    }
}
