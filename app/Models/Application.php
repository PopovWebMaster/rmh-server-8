<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'application';
    protected $fillable = [
        'company_id', 
        'category_id', 
        'manager_id',
        'name', 
        'num', 
        'manager_notes', 

    ];

    public $timestamps = true;
}
