<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengambilanSampel extends Model
{
    use HasFactory;

    protected $table = 'status_pengambilan_sampel';
    protected $guarded = [];

    public function timelinePengambilanSampel()
    {
        return $this->hasMany(TimelinePengambilanSampel::class, 'id_status_pengambilan_sampel', 'id');
    }

    public function pengambilanSampelOrder()
    {
        return $this->hasOne(PengambilanSampelOrder::class, 'id_status_pengambilan_sampel', 'id');
    }
}
