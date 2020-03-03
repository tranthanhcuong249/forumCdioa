<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    //
    protected $table = 'webs';

    protected $fillable = [
        'name', 'url', 'sort',
    ];
}
