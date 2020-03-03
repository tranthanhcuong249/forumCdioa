<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicType extends Model
{
    //
    protected $table = 'topic_types';

    protected $fillable = [
      'name', 'slug', 'status',
    ];
}
