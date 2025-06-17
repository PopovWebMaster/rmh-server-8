<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GridEvents extends Model
{
    use HasFactory;

    protected $table = 'grid_events';
    protected $fillable = [
        'company_id',
        'day_num',
        'is_a_key_point',
        'start_time',
        'duration_time',
        'event_id',
        'first_segment_id',
        'notes',
        'cut_part',
        'push_it',
    ];

    public $timestamps = true;
}
