<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyPoints extends Model
{
    use HasFactory;

    protected $table = 'key_points';
    protected $fillable = [
        'company_id', 
        'dayNum',
        'time',
        'description',
        'ms'
    ];

    public $timestamps = true;
}
