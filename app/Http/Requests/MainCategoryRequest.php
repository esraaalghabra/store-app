<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'details'  => 'required',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png,jfif,webp',
            'photo_first' => 'required_without:id|mimes:jpg,jpeg,png,jfif,webp',
            'photo_second' => 'required_without:id|mimes:jpg,jpeg,png,jfif,webp',
        ];
    }
}
