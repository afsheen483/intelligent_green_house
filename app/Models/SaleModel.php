<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleModel extends Model
{
    use HasFactory;
    protected $table = 'sales';
    public $timestamps = false;
    protected $fillable = [
        'customer_id',
        'greenhouse_id',
        'amount',
        'installation_amount',
        'discount_amount',
        'advance_amount',
        'date',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];

}
