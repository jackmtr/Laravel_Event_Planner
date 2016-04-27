<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateContactRequest extends Request
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
            'first_name' => 'max:50',
            'last_name' => 'required|max:50',
            'email' => 'email', //|unique:contacts but causing issues with updating contacts and not wanting to change the email
            'occupation' => 'max:100',
            'company' => 'max:100',
            'wechat_id' => 'integer|min:6',
            'notes' => 'max:255',
        ];
    }
}
