<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProgramSystem extends Model
{
    use HasFactory;

    protected $table = 'company_program_system';
    protected $fillable = [
        'name', 
        'company_id',
    ];

    public $timestamps = true;
}
