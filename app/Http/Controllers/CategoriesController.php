<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Validator;
use Response;
use Auth;
use Illuminate\Support\Facades\Input;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->can('view',Categories::class)) {
            $allcategories=Categories::paginate(3);
            return view('admin.pages.categories.list',['categories'=>$allcategories]);
        }
        else {
            return view('errors.error403');
//            echo "Bạn không có quyền vào trang này !"."<br/>";
//            echo "Vui lòng chọn chức năng phù hợp với vai trò của bạn !";
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
        if($user->can('create',Categories::class)) {
            return view('admin.pages.categories.addcat');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $user = Auth::user();
        if($user->can('create',Categories::class)) {
            Categories::create([
                'name' => $request->name,
                'slug' => utf8tourl($request->name),
                'status' => $request->status,
            ]);
            return redirect()->route('categories.index');
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
        $user = Auth::user();
        if($user->can('update',Categories::class)) {
            $category = Categories::find($id);
            return response()->json($category, 200);
        }
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
        $user = Auth::user();
        if($user->can('update',Categories::class)) {
            $category = Categories::find($id);
            //dd($request);
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|min:3|max:255',
                ],
                [
                    'required' => 'Tên danh mục không được để trống',
                    'min' => 'Tên danh mục phải từ 3 đến 255 kí tự',
                    'max' => 'Tên danh mục phải từ 3 đến 255 kí tự',
                ]
            );
            if ($validator->fails()) {
                return response()->json(['error' => 'true', 'message' => $validator->errors()], 200);
            } else {
                $category->update([
                        'name' => $request->name,
                        'slug' => utf8tourl($request->name),
                        'status' => $request->status,
                    ]
                );
                return response()->json(['success' => 'sửa danh mục sản phẩm thành công']);
            }
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
        if($user->can('delete',Categories::class)) {
            $category = Categories::find($id);
            if(count($category->productType)===0) {
                $category->delete();
                return response()->json(['success' => 'xóa danh mục sản phẩm thành công']);
            }
            else {
                return response()->json(['success' => 'không thế xóa được']);
            }

        }
    }
}

