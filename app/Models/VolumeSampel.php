<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolumeSampel extends Model
{
    use HasFactory;

    protected $table = 'volume_sampel';
    protected $guarded = [];

    public function pengambilanSampelOrder()
    {
        return $this->hasMany(PengambilanSampelOrder::class, 'id_volume_sampel', 'id');
    }
}
