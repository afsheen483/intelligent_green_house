<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    use HasFactory;
    protected $table = 'report';
    public $timestamps = false;
    protected $fillable = [
        'session_id',
        'average_temp',
        'average_humidity',
        'average_soil_moisture',
        'day_no',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
