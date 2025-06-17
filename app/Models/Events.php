<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = [
        'company_id', 
        'category_id',
        'name',
        'notes',
        'type',
        'durationTime',
    ];

    public $timestamps = true;
}
