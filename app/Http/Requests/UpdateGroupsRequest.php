<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupsRequest extends FormRequest
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
            'name' => 'required|unique:groups|',
        ];
    }
    public function messages()
    {
        return  [
                'name.required' => 'Vui lòng không được để trống',
                'name.unique'   => 'Vui lòng không được trùng dữ liệu',
            ];
    }
}
