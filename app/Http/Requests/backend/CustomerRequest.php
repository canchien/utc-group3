<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CustomerRequest extends FormRequest
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
        $rules = [
            'email' => 'email|required|unique:users,email,' . $request->id,
            'phone' => 'required|numeric',
            'name' => 'required',
            'address' => 'required',
            'sex'=>'required'
        ];
        if (!$this->id) {
            $rules['password'] ='required';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'phone.numeric' => 'Hãy nhập đúng định dang số đt',
            'email.email' => "Nhập đúng định dạng email",
            'email.required' => 'Không được để trống email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu phải lớn hơn 5 ký tự',
            'address.required' => 'Không được để trống địa chỉ',
            'name.required' => 'Không được để trống tên',
            'sex.required' => 'Hãy chọn giới tính',
        ];
    }
}
