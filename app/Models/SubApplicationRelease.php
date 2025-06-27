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

    public const RULE = [
        'id' =>             [ 'required', 'exists:sub_application_release,id' ],
        'sub_application_id' => [  ],
        'grid_event_id' =>      [  ],
        'date' =>               [  ],
        'time_sec' =>           [  ],

        // 'name' =>           [ 'required', 'string', 'max:255' ],
        // 'notes' =>          [ 'nullable', 'string', 'max:255' ],
        // 'type' =>           [ 'required', 'string', 'in:file,block' ],
        // 'category_id' =>    [ 'nullable', 'exists:category,id' ],
        // 'durationTime' =>   [ 'required', 'string', 'max:10' ],

    ];
}
