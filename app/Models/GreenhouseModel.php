<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenhouseModel extends Model
{
    use HasFactory;
    protected $table = 'green_house';
    public $timestamps = false;
    protected $fillable = [
        'mac_address',
        'name',
        'serial_number',
        'soil_nodes',
        'temperature_nodes',
        'humidity_nodes',
        'green_house_location',
        'amount',
        'fan_status',
        'heater_status',
        'motor_status',
        'sun_light_status',
        'customer_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
