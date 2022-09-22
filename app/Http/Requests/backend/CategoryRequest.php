<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'categoryName' => 'required|unique:categories,name,' . $request->edit_category_id,
            'category_keyword' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'categoryName.required' => 'Hãy nhập tên',
            'categoryName.min' => 'Tên phải lớn hơn 5 ký tự',
            'categoryName.unique' => 'Tên danh mục đã tồn tại trong hệ thống',
            'category-description.min' => 'Mô tả phải lớn hơn 5 ký tự',
            'category-description.required' => 'Hãy nhập mô tả cho tên Category',
            'category_keyword.required' => 'Hãy nhập một vài từ khoá cho tên Category'

        ];
    }
}
