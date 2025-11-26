<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeRelease extends Model
{
    use HasFactory;

    protected $table = 'free_release';
    protected $fillable = [
        'company_id',
        'event_id',
        'file_name',
        'duration',
    ];

    public $timestamps = false;
}
