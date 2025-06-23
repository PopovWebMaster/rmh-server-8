<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = [
        'name', 
        'prefix', 
        'colorText', 
        'colorBG', 
    ];

    public $timestamps = true;

    public const RULE = [
        'id' =>         [ 'required', 'exists:category,id' ],
        'name' =>       [ 'required', 'string', 'max:255' ],
        'prefix' =>     [ 'nullable', 'string', 'max:255' ],
        'colorText' =>  [ 'required', 'string', 'min:4', 'max:20' ],
        'colorBG' =>    [ 'required', 'string', 'min:4', 'max:20' ],

    ];

}
