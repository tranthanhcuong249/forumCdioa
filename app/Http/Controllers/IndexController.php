<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Categories;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getIndex() {

        $getUser = User::all();
        $getCate = Categories::all();
        $getPro = Product::all();
        $getProType = ProductType::all();
        return view('admin.pages.index',['getUser'=>$getUser,'getCate' => $getCate,'getPro' =>$getPro,
            'getProType'=> $getProType]);
    }
}
