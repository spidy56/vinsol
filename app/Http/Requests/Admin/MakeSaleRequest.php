<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MakeSaleRequest extends FormRequest
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
        $validator = [
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'discounted_price' => 'required|numeric|lte:price',
            'quantity' => 'required|numeric',
            'publish_date' => 'required|date|unique:sale_products,publish_date',
            'sale_image' => 'required|mimes:png,jpg,jpeg,JPEG,JPG,PNG|max:3072',
        ];
        return $validator;
    }
}
