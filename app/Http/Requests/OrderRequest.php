<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required',
            'payment_type' => 'required',
            // 'status' => 'required',
            // 'payment_status' => 'required',

        ];
    }
}
