<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'name' => 'required|string|max: 255|unique:brands,name,' . $this->id,
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'position' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }
}
