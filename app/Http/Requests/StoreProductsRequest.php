<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
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
            'name' => 'required|unique:products|min:3',
            'category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'inputFile' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ];
    }
    public function messages()
    {
        return  [
                'name.required' => 'Vui lòng không được để trống',
                'name.unique'   => 'Vui lòng không được trùng dữ liệu',
                'name.min'      => 'Vui lòng nhập trên :min kí tự',
                'description.required' => 'Vui lòng không được để trống',
                'price.required' => 'Vui lòng không được để trống',
                'category_id.required' => 'Vui lòng không được để trống',
                'inputFile.required' => 'Vui lòng không được để trống',
                'price.required' => 'Vui lòng không được để trống',
                'quantity.required' => 'Vui lòng không được để trống'
            ];
    }
}
