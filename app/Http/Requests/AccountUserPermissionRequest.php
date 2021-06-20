<?php


namespace App\Services;


class AccountUserPermissionRequest
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
            'account_id'=> 'required|numeric',
            'user_id'=> 'required|numeric',
            'permission_id'=> 'required|numeric',
        ];
    }
}
