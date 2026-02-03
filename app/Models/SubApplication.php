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

    public const RULE = [
        'id' =>                     [ 'required', 'exists:sub_application,id' ],
        'application_id' =>         [ 'required', 'exists:application,id' ],
        'period_from' =>            [ 'required', 'string' ],
        'period_to' =>              [ 'required', 'string' ],
        'duration_sec' =>           [ 'required', 'numeric', 'min:2', 'max:86400' ],
        'name' =>                   [ 'required', 'string', 'max:255' ],
        'serial_num_for_series' =>  [ 'required', 'numeric', 'min:1', 'max:1000000' ],
        'serial_num_for_release' => [ 'nullable', 'numeric', 'min:1', 'max:1000000' ],
        'air_notes' =>              [ 'nullable', 'string', 'max:255' ],
        'type' =>                   [ 'required', 'string', 'in:series,release' ],


    ];
}
