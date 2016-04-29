<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
        /*return [
            'first_name' => 'alpha|max:50',//we will need to check if chinese letters can be accepted
            'last_name' => 'required|alpha|max:50',
            'email' => 'email', //|unique:contacts but causing issues with updating contacts and not wanting to change the email
            'occupation' => 'max:100',
            'company' => 'max:100',
            'phone_number' => 'string',//linked to the phone number creation
            'wechat_id' => 'integer|min:6',
            'notes' => 'max:255',
        ];*/

        $rules = [
            'first_name' => 'alpha|max:50',//we will need to check if chinese letters can be accepted
            'last_name' => 'required|alpha|max:50',
            'email' => 'email', //|unique:contacts but causing issues with updating contacts and not wanting to change the email
            'occupation' => 'max:100',
            'company' => 'max:100',
            'phone_number' => 'string',//linked to the phone number creation
            'wechat_id' => 'string',//we can add better validation later
            'notes' => 'max:255',
        ];
        
        //need to check for edit page
        /*if ($condition){
            $rules['email'] = 'email';
        }*/

        return $rules;
    }
}
