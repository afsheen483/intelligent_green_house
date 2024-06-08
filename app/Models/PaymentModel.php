<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = 'payments';
    public $timestamps = false;
    protected $fillable = [
        'debit',
        'credit',
        'type',
        'description',
        'date',
        'entry_date',
        'sale_id',
        'customer_id',
        'maintain_id',
        'user_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
