<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionModel extends Model
{
    use HasFactory;
    protected $table = 'session';
    public $timestamps = false;
    protected $fillable = [
        'plant_id',
        'green_house_id',
        'user_id',
        'start_date',
        'plant_age',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
