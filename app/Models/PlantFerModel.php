<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantFerModel extends Model
{
    use HasFactory;
    protected $table = 'plant_fertilizer';
    public $timestamps = false;
    protected $fillable = [
        'plant_id',
        'fertilizer_id',
        'quantity',
        'time_duration',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];

}
