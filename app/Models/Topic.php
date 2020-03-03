<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $table = 'topics';

    protected $fillable = [
        'title', 'slug', 'status', 'idUser', 'idTopicType', 'image', 'content', 'note',
    ];

    public function User() {
        return $this->belongsTo('App\Models\Product','idUser','id');
    }

    public function TopicType() {
        return $this->belongsTo('App\Models\Product','idTopicType','id');
    }
}
