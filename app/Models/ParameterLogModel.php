<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterLogModel extends Model
{
    use HasFactory;
    protected $table = 'parameter_log';
    public $timestamps = false;
    protected $fillable = [
        'session_id',
        'current_temperature',
        'current_humidity',
        'currrent_soil_moisture',
        'date',
    ];
}
