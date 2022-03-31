<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class MeetingRequest extends FormRequest
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
            'topic' => 'required|string',
            'agenda' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'hours' => 'required|numeric',
            'minutes' => 'required|numeric',
            'user_authentication' => 'required|boolean',
            'passcode' => 'sometimes'
        ];
    }
}
