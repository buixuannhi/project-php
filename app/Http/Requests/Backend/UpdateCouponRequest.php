<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'code' => 'required|unique:coupons,code,' . $this->id,
            'limit' => 'required|numeric',
            'percent' => 'required|numeric',
            'min_price' => 'required|numeric',
            'start_time' => 'required|date|date_format:d/m/Y H:i A',
            'end_time' => 'required|date|date_format:d/m/Y H:i A|after:start_time',
            'status' => 'required',
        ];
    }
}
