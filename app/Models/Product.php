<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'name', 'slug', 'description', 'quantity', 'price', 'promotional', 'image', 'idCategories', 'idProductType', 'status',
    ];

    public function ProductType() {
        return $this->belongsTo('App\Models\ProductType','idProductType','id');
    }

    public function Categories() {
        return $this->belongsTo('App\Models\Categories','idCategories','id');
    }
}
