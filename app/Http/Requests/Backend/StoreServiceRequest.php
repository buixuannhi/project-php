<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'title' => 'required|string|max: 255',
            'position' => 'required|numeric',
            'content' => 'required',
            'price' => 'required|numeric',
            'service_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required|numeric',
        ];
    }
}
