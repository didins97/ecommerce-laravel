<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
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
            "product_name" => "required|max:25|unique:products",
            "price" => "required|numeric",
            "stock" => "required|numeric",
            "description" => "required",
            "cat_id" => "required",
            "child_cat_id" => "required",
        ];
    }
}
