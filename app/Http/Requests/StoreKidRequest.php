<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKidRequest extends FormRequest
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
            'first_name'    => 'required|min:3|max:25|string',
            'last_name'     => 'min:3|max:35|string|nullable',
            'dim_name'      => 'min:2|max:20|string|nullable',
            'birth_date'    => 'required|date',
            'about'         => 'min:5|max:2048|nullable',
            'gender'        => 'numeric|required',
            'avatar'        => 'image|mimes:jpg,png,gif|nullable'
        ];
    }
}
