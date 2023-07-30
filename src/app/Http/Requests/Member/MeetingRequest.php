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
            'date' => 'required|date_format:Y-m-d|after_or_equal:date',
            'time' => 'required|date_format:H:i',
        ];
    }
}
