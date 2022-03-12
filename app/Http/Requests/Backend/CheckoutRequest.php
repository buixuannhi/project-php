<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|max:255|min:10',
            'email' => 'required|email',
            'phone' => 'required|max:15|min:10',
            'address' => 'required',
            'depart_date' => 'required',
            'arrive_date' => 'required',
            'children' => 'required|numeric',
            'adult' => 'required|numeric',
        ];
    }
}
