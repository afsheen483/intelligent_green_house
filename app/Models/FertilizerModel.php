<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizerModel extends Model
{
    use HasFactory;
    protected $table = 'fertilizer_info';
    public $timestamps = false;
    protected $fillable = [
        'fertilizer_name',
        'user_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
