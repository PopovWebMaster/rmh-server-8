<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubApplication extends Model
{
    use HasFactory;

    protected $table = 'sub_application';
    protected $fillable = [
        'application_id', 
        'period_from', 
        'period_to', 
        'duration_sec', 
        'name', 
        'serial_num', 
        'air_notes', 
        'type', 

    ];

    public $timestamps = true;
}
