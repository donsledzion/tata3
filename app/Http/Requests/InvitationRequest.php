<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
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
            'account_id'    =>  'required|numeric',
            'inviting_id'   =>  'required|numeric|different:invited_id',
            'invited_id'    =>  'required|numeric|different:inviting_id',
            'permission_id' =>  'required|numeric',
            'message'       =>  'nullable|max:2048',
        ];
    }
}
