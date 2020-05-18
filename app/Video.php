<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $fillable = [
        'disk', 'original_name', 'path', 'title'
    ];
}
