<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterSampel extends Model
{
    use HasFactory;

    protected $table = 'parameter_sampel';
    protected $guarded = [];

    public function sampelUji()
    {
        return $this->belongsTo(SampelUji::class, 'id_sampel_uji', 'id');
    }

    public function parameterSampelOrder()
    {
        return $this->hasMany(ParameterSampelOrder::class, 'id_parameter_sampel', 'id');
    }
    
}
