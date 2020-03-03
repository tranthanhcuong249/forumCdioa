<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role', 'status', 'phone', 'avatar','social_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';

    public function Customer() {
        return $this->hasMany('App\Models\Customer','idUser','id');
    }
}
