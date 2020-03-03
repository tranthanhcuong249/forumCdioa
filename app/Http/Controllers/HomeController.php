<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\ProductType;
use App\Models\Product;
use Cart;
use Auth;

class HomeController extends Controller
{
    public function __construct(){
        $category = Categories::where('status',1)->get();
        $producttype = ProductType::where('status',1)->get();
        view()->share(['category' => $category,'producttype' => $producttype]);
    }

    public function index(){
        $product1 = Product::where('status',1)->where('idCategories',1)->get();
        $product2 = Product::where('status',1)->where('idCategories',2)->get();
        $product3 = Product::where('status',1)->where('idCategories',3)->get();
        $product4 = Product::where('status',1)->where('idCategories',4)->get();
        $product5 = Product::where('status',1)->where('idCategories',5)->get();
        return view('client.pages.index',[
            'procacanh' => $product1,
            'procaycanh' => $product2,
            'prochimcanh' => $product3,
            'prophukien' => $product4,
            'promoichimca' => $product5,

        ]);
    }

    public function getDetail($slug) {
        $productDetail = Product::where('slug', $slug)->first();
        $idProType = ProductType::where('slug', $slug)->first();

        if (count($productDetail) > 0) {
            return view('client.pages.detail', ['product' => $productDetail]);
        }
        else if( count($idProType) > 0 ) {
            $productByProdType = Product::where('idProductType', $idProType->id)->get();
            return view('client.pages.detail_protype', ['product' => $productByProdType, 'producttype' => $idProType]);
        }
    }
}
