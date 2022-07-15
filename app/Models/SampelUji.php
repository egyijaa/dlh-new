<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampelUji extends Model
{
    use HasFactory;

    protected $table = 'sampel_uji';
    protected $guarded = [];

    public function parameterSampel()
    {
        return $this->hasMany(ParameterSampel::class, 'id_sampel_uji', 'id');
    }

    public function sampelOrder()
    {
        return $this->hasMany(SampelOrder::class, 'id_sampel_uji', 'id');
    }
}
