<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLinkedFile extends Model
{
    use HasFactory;

    protected $table = 'event_linked_file';
    protected $fillable = [
        'company_id',
        'event_id',
        'name',
        'duration',
    ];

    public $timestamps = false;
}
