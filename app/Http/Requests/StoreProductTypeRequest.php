<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductTypeRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:product_types,name'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải từ 3 đến 255 kí tự',
            'max' => ':attribute phải từ 3 đến 255 kí tự',
            'unique' => ':attribute không được trùng nhau'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên loại sản phẩm',
        ];
    }
}
