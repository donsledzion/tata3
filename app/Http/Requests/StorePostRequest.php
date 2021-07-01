<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'said_at' => 'date|required',
            'author_id' => 'numeric|required',
            'kid_id' => 'numeric|required',
            'sentence' => 'min:3|max:2048|required',
            'picture' => 'image|mimes:png,jpg,gif|nullable',
            'status_id' => 'numeric|required'
        ];
    }
}
