<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'name' => 'required|unique:rooms,name,' . $this->id . '|max:255|min:10',
            'slug' => 'required|unique:rooms,slug,' . $this->id . '|max:255|min:10',
            'room_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'image_details.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'numeric',
            'bed' => 'required|numeric',
            'bath' => 'required|numeric',
            'area' => 'required|numeric',
            'quantity' => 'required|numeric',
            'status' => 'required',
            'description' => 'required',
        ];
    }
}
