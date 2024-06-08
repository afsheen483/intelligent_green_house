<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintainModel extends Model
{
    use HasFactory;
    protected $table = 'maintainanace';
    public $timestamps = false;
    protected $fillable = [
        'note',
        'feedback',
        'user_id',
        'green_house_id',
        'work_hours',
        'location',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];
}
