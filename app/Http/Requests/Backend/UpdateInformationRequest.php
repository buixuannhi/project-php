<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInformationRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|string|min:10|max:14',
            'address' => 'required',
            'email' => 'required|email|max:255',
            'map' => 'required',
            'logo_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
