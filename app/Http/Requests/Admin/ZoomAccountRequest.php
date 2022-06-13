<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ZoomAccountRequest extends FormRequest
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
            'zoom_app_id' => 'required|exists:zoom_apps,id|unique:zoom_accounts,zoom_app_id',
            'capacity' => 'required|numeric',
            'email' => 'required|unique:zoom_accounts,email'
        ];
    }
}
