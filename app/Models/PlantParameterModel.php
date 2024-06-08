<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantParameterModel extends Model
{
    use HasFactory;
    protected $table = 'plant_parameter';
    public $timestamps = false;
    protected $fillable = [
        'plant_id',
        'parameter_id',
        'range_from',
        'range_to',
        'request_value',
        'threshold',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
