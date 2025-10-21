<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirFilePrefix extends Model
{
    use HasFactory;

    protected $table = 'air_file_prefix';
    protected $fillable = [
        'prefix', 
        'company_id',
        'event_id',
    ];

    public $timestamps = false;

    public const RULE = [
        'id' =>             [ 'required', 'exists:air_file_prefix,id' ],
        'company_id' =>     [ 'required', 'exists:company,id' ],
        'prefix' =>         [ 'required', 'string', 'min:2', 'max:60' ],
        'event_id' =>       [ 'required', 'exists:events,id' ],
    ];
}
