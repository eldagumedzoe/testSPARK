<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Converter extends Model
{
    //
    protected $fillable = [
        'height',
        'weight',  
        'total_bmi',
        'isreset'

    ];
}
