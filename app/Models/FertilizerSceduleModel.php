<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizerSceduleModel extends Model
{
    use HasFactory;
    protected $table = 'fertilizer_schedule';
    public $timestamps = false;
    protected $fillable = [
        'plant_fertilizer_id',
        'day_no',
        'user_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
