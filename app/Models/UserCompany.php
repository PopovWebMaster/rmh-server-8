<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    use HasFactory;

    protected $table = 'user_company';
    protected $fillable = [
        'user_id', 
        'company_id',
    ];

    public $timestamps = true;
}
