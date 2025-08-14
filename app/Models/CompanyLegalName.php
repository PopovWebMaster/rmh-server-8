<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLegalName extends Model
{
    use HasFactory;

    protected $table = 'company_legal_name';
    protected $fillable = [
        'name', 
        'company_id',
    ];

    public $timestamps = true;
}
