<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventRequest extends Request
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
            'event_name' => 'required|min:3',
            'event_date' => 'date',
            //'event_time' => '',//not sure how to validate this
            'event_location' => 'min:3',
            //'event_description' => '',
            'num_of_tables' => 'integer',
            'seats_per_table' => 'integer',
            'event_status' => 'integer',
        ];
    }


}
