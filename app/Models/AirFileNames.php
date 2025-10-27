<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirFileNames extends Model
{
    use HasFactory;

    protected $table = 'air_file_names';
    protected $fillable = [
        'company_id', 
        'name',
        'event_id',
        'premiere_sec'
    ];

    public $timestamps = false;

    public const RULE = [
        'company_id' =>     [ 'required', 'exists:company,id' ],
        'name' =>           [ 'required', 'string', 'min:5', 'max:250' ],
        'event_id' =>       [ 'nullable', 'exists:events,id' ],
        'premiere_sec' =>   [ 'nullable', 'numeric' ],

    ];


}
