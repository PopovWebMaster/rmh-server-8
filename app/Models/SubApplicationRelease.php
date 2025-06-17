<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubApplicationRelease extends Model
{
    use HasFactory;

    protected $table = 'sub_application_release';
    protected $fillable = [
        'sub_application_id', 
        'grid_event_id', 
        'date', 
        'time_sec', 

    ];

    public $timestamps = true;
}
