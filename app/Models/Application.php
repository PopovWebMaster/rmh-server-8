<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'application';
    protected $fillable = [
        'company_id', 
        'category_id', 
        'manager_id',
        'name', 
        'num', 
        'manager_notes', 
        'event_id',

    ];

    public $timestamps = true;

    public const RULE = [
        'id' =>             [ 'required', 'exists:application,id' ],
        'company_id' =>     [ 'required', 'exists:company,id' ],
        'category_id' =>    [ 'nullable', 'exists:category,id' ],
        'manager_id' =>     [ 'nullable', 'exists:users,id' ],
        'name' =>           [ 'required', 'string', 'min:1', 'max:255' ],
        'num' =>            [ 'nullable', 'numeric', 'min:0', 'max:1000000' ],
        'manager_notes' =>  [ 'nullable', 'string' ],
        'event_id' =>       [ 'nullable', 'exists:events,id' ],



    ];
}
