<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbp extends Model
{
    use HasFactory;

    protected $table = 'tbp';
    protected $guarded = [];

    public function pengujianOrder()
    {
        return $this->belongsTo(PengujianOrder::class, 'id_pengujian_order', 'id');
    }
}
