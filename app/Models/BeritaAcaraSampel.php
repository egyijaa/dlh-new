<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcaraSampel extends Model
{
    use HasFactory;

    protected $table = 'berita_acara_sampel';
    protected $guarded = [];

    public function pengambilanSampelOrder()
    {
        return $this->belongsTo(PengambilanSampelOrder::class, 'id_pengambilan_sampel_order', 'id');
    }
}
