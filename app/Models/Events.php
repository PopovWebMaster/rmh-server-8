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

    public const RULE = [
        'id' =>             [ 'required', 'exists:events,id' ],
        'name' =>           [ 'required', 'string', 'max:255' ],
        'notes' =>          [ 'nullable', 'string', 'max:255' ],
        'type' =>           [ 'required', 'string', 'in:file,block' ],
        'category_id' =>    [ 'nullable', 'exists:category,id' ],
        'durationTime' =>   [ 'required', 'string', 'max:10' ],

    ];

}
