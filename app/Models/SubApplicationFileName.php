<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubApplicationFileName extends Model
{
    use HasFactory;

    protected $table = 'sub_application_file_name';
    protected $fillable = [
        'sub_application_id', 
        'file_name', 

    ];

    public $timestamps = true;
}
