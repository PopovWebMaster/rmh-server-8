<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCity extends Model
{
    use HasFactory;

    protected $table = 'company_city';
    protected $fillable = [
        'name', 
        'company_id',
    ];

    public $timestamps = true;
}
