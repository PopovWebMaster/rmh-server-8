<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessRight extends Model
{
    use HasFactory;

    protected $table = 'user_access_right';
    protected $fillable = [
        'user_id', 
        'access',
    ];

    public $timestamps = true;
}
