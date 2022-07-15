<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterSampelOrder extends Model
{
    use HasFactory;

    protected $table = 'parameter_sampel_order';
    protected $guarded = [];

    public function sampelOrder()
    {
        return $this->belongsTo(SampelOrder::class, 'id_sampel_order', 'id');
    }

    public function parameterSampel()
    {
        return $this->belongsTo(ParameterSampel::class, 'id_parameter_sampel', 'id');
    }

}
