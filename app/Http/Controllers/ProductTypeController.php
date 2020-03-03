<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\ProductType;
use Validator;
use Response;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductTypeRequest;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producttype = ProductType::all();
        return view('admin.pages.producttype.list',['producttype'=>$producttype]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::where('status',1)->get();
        return view('admin.pages.producttype.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTypeRequest $request)
    {
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if(ProductType::create($data)) {
            return redirect()->route('producttype.index')->with('thongbao','Đã thêm thành công loại sản phẩm');
        }
        else {
            return back()->with('thongbao','Đã có lỗi xảy ra vui lòng kiểm tra lại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producttype = ProductType::find($id);
        $category = Categories::where('status',1)->get();
        return response()->json(['category'=>$category, 'producttype' => $producttype],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producttype = ProductType::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:3|max:255',
            ],
            [
                'name.required' => 'Tên loại sản phẩm không được để trống',
                'name.min' => 'Tên loại sản phẩm phải từ 3 đến 255 kí tự',
                'name.max' => 'Tên loại sản phẩm phải từ 3 đến 255 kí tự',
            ]);

        if($validator->fails()) {
            return response()->json(['error' => 'true','message' => $validator->errors()],200);
        }
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($producttype->update($data)) {
            return response()->json(['success' => 'Đã sửa thành công loại sản phẩm có id là'.$id],200);
        }
        else {
            return response()->json(['success' => 'Đã có lỗi xảy ra với loại sản phẩm có id'.$id],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producttype = ProductType::find($id);
        if(count($producttype->product)===0) {
            if ($producttype->delete()) {
                return response()->json(['success' => 'Đã xóa thành công loại sản phẩm là ' . $producttype->name], 200);
            } else {
                return response()->json(['success' => 'Đã có lỗi xảy ra với loại sản phẩm là ' . $producttype->name], 200);
            }
        }
        else {
            return response()->json(['success' => 'Đã có lỗi xảy ra  ' . $producttype->name], 200);
        }
    }
}
