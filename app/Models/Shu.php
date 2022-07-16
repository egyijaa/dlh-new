<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shu extends Model
{
    use HasFactory;

    protected $table = 'shu';
    protected $guarded = [];

    public function sampelOrder()
    {
        return $this->belongsTo(SampelOrder::class, 'id_sampel_order', 'id');
    }
}
