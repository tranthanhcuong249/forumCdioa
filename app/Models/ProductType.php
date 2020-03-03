<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $table = 'product_types';

    protected $fillable = [
        'idCategories', 'name', 'slug', 'status',
    ];

    public function Categories() {
        return $this->belongsTo('App\Models\Categories','idCategories','id');
    }
    public function product() {
        return $this->hasMany('App\Models\Product','idProductType','id');
    }
}
