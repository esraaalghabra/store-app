<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine
     * if the user is authorized to make this request.
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
            'name' => 'required|string',
            'details' => 'required|string',
            'price' => 'required|numeric',
            'size' => 'required|numeric',
            'amount' => 'required|numeric',
            'main_category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
            'vendor_id' => 'required|numeric',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png,jfif,webp',
            'photo_first' => 'mimes:jpg,jpeg,png,jfif,webp',
            'photo_second' => 'mimes:jpg,jpeg,png,jfif,webp',
        ];
    }
}
