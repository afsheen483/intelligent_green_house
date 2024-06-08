<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    use HasFactory;
    protected $table = 'customer_request';
    public $timestamps = false;
    protected $fillable = [
        'customer_name',
        'email',
        'phone_no',
        'address',
        'description',
        'created_at',
        'status',
    ];
}
