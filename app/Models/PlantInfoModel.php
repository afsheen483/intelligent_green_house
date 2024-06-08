<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantInfoModel extends Model
{
    use HasFactory;
    protected $table = 'plant_info';
    public $timestamps = false;
    protected $fillable = [
        'plant_name',
        'plant_description',
        'plant_life_duration',
        'user_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
