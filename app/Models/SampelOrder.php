<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampelOrder extends Model
{
    use HasFactory;

    protected $table = 'sampel_order';
    protected $guarded = [];

    public function pengujianOrder()
    {
        return $this->belongsTo(PengujianOrder::class, 'id_pengujian_order', 'id');
    }

    public function sampelUji()
    {
        return $this->belongsTo(SampelUji::class, 'id_sampel_uji', 'id');
    }

    public function shu()
    {
        return $this->hasOne(Shu::class, 'id_sampel_order', 'id');
    }

    public function parameterSampelOrder()
    {
        return $this->hasMany(ParameterSampelOrder::class, 'id_sampel_order', 'id');
    }
    
}
