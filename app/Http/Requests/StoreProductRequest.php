<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255|unique:products,name',
            'description' => 'required|min:3',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'promotional' => 'numeric',
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải từ 3 đến 255 kí tự',
            'max' => ':attribute phải từ 3 đến 255 kí tự',
            'unique' => ':attribute không được trùng nhau',
            'integer' => ':attribute phải là số nguyên',
            'float' => ':attribute phải là số thực',
            'image' => ':attribute phải là hình ảnh'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'quantity' => 'Số lượng sản phẩm',
            'price' => 'Đơn gía sản phẩm',
            'promotional' => 'Đơn giá khuyến mãi',
            'image' => 'Hình ảnh sản phẩm',

        ];
    }
}
