<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\ProductType;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getProductType(Request $request) {
        $producttype = ProductType::where('idCategories',$request->idCate)->get();
        return response()->json($producttype,200);
    }
}
