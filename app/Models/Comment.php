<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';

    protected $fillable = [
        'idUser', 'idProduct', 'message',
    ];

    public function User() {
        return $this->belongsTo('App\Models\User','idUser','id');
    }

    public function Product() {
        return $this->belongsTo('App\Models\Product','idProduct','id');
    }
}
