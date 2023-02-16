<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users|min:7',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'group_id' => 'required',
            'gender' => 'required',
            'image' => 'required',
            'address' => 'required'
        ];
    }
    public function messages()
    {
        return  [
                'email.required' => 'Vui lòng không được để trống',
                'email.unique'   => 'Vui lòng không được trùng dữ liệu',
                'email.min'      => 'Vui lòng nhập trên :min kí tự',
                'password.required' => 'Vui lòng không được để trống',
                'name.required' => 'Vui lòng không được để trống',
                'phone.required' => 'Vui lòng không được để trống',
                'birthday.required' => 'Vui lòng không được để trống',
                'group_id.required' => 'Vui lòng không được để trống',
                'gender.required' => 'Vui lòng không được để trống',
                'image.required' => 'Vui lòng không được để trống',
                'address.required' => 'Vui lòng không được để trống'
            ];
    }
}
