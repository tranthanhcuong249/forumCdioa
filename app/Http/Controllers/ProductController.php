<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\ProductType;
use App\Http\Requests\StoreProductRequest;
use Validator;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->can('view',Product::class)) {
            $product = Product::all();
            return view('admin.pages.product.listproduct', ['product' => $product]);
        }
        else {
            echo "Bạn không có quyền vào trang này !"."<br/>";
            echo "Vui lòng chọn chức năng phù hợp với vai trò của bạn !";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->can('create',Product::class)) {
            $categories = Categories::where('status', 1)->get();
            $producttype = ProductType::where('status', 1)->get();
            return view('admin.pages.product.addproduct', compact('categories', 'producttype'));
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\StoreProductRequest $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $user = Auth::user();
        if($user->can('create',Product::class)) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                //lay tên file getClient
                $file_name = $file->getClientOriginalName();
                // loại file
                $file_type = $file->getMimeType();
                //kick thuoc file
                $file_size = $file->getSize();
                if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                    if ($file_size <= 1048576) {
                        $file_name = date('d-m-y') . '-' . rand() . '-' . utf8tourl($file_name);
                        if ($file->move('img/upload/product', $file_name)) {
                            $data = $request->all();
                            $data['slug'] = utf8tourl($request->name);
                            $data['image'] = $file_name;
                            if (Product::create($data)) {
                                return redirect()->route('product.index')->with('thongbao', 'Thêm thành công');
                            } else {
                                return back()->with('thongbaoproduct', 'Đã có lỗi xảy ra');
                            }
                        }

                    } else {
                        return back()->with('thongbaoproduct', 'Không thể upload ảnh kích thước quá 10mb');
                    }
                } else {
                    return back()->with('thongbaoproduct', 'Không thể upload file khác loại ảnh');
                }

            } else {
                return back()->with('thongbaoproduct', 'Bạn chưa thêm ảnh minh họa sản phẩm');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if($user->can('update',Product::class)) {
            $categories = Categories::where('status', 1)->get();
            $producttype = ProductType::where('status', 1)->get();
            $product = Product::find($id);
            return response()->json(['categories' => $categories, 'producttype' => $producttype, 'product' => $product], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if($user->can('update',Product::class)) {
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|min:3|max:255',
                    'description' => 'required|min:3',
                    'quantity' => 'required|numeric',
                    'price' => 'required|numeric',
                    'promotional' => 'numeric',
                    'image' => 'image'
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute phải từ 3 đến 255 kí tự',
                    'max' => ':attribute phải từ 3 đến 255 kí tự',
                    'numeric' => ':attribute phải là số nguyên',
                    'numeric' => ':attribute phải là số thực',
                    'image' => ':attribute phải là hình ảnh'
                ],
                [
                    'name' => 'Tên sản phẩm',
                    'description' => 'Mô tả sản phẩm',
                    'quantity' => 'Số lượng sản phẩm',
                    'price' => 'Đơn gía sản phẩm',
                    'promotional' => 'Đơn giá khuyến mãi',
                    'image' => 'Hình ảnh sản phẩm',
                ]
            );
            if ($validator->fails()) {
                return response()->json(['error' => 'true', 'message' => $validator->errors()], 200);
            }
            $product = Product::find($id);
            $data = $request->all();
            $data['slug'] = utf8tourl($request->name);
            if ($request->hasFile('image')) {
                $file = $request->image;
                //lay tên file getClient
                $file_name = $file->getClientOriginalName();
                // loại file
                $file_type = $file->getMimeType();
                //kick thuoc file
                $file_size = $file->getSize();
                if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                    if ($file_size <= 1048576) {
                        $file_name = date('d-m-y') . '-' . rand() . '-' . utf8tourl($file_name);
                        if ($file->move('img/upload/product', $file_name)) {
                            $data['image'] = $file_name;
                            if (File::exists('img/upload/product' . $product->image)) {
                                unlink('img/upload/product' . $product->image);
                            }
                        }

                    } else {
                        return response()->json(['error', 'Ảnh của bạn có dung lượng quá lớn'], 200);
                    }
                } else {
                    return response()->json(['error', 'File đã chọn không phải là ảnh'], 200);
                }

            } else {
                $data['image'] = $product->image;
            }


            $product->update($data);
            return response()->json(['result' => 'Đã sửa thành công sản phẩm'], 200);
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
        $user = Auth::user();
        if($user->can('delete',Product::class)) {
            $product = Product::find($id);
            if ($product->delete()) {
                return response()->json(['success' => 'Đã xóa thành công loại sản phẩm có id là' . $id], 200);

            } else {
                return response()->json(['success' => 'Đã có lỗi xảy ra với loại sản phẩm có id' . $id], 200);
            }
        }
    }
}
