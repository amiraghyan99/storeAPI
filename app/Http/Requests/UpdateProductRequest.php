<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'description' => 'required|max:200',
            'count' => 'required|numeric|min:0',
            'category_ids' => 'array|required|min:1',
            'category_ids.*' => 'required|exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'required|file|image|mimes:jpg,jpeg,png,gif|max:2048'
        ];
    }
}
