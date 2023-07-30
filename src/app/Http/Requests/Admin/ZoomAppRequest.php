<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use function PHPSTORM_META\map;

class ZoomAppRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                Rule::unique('zoom_apps', 'name')
                    ->ignore($this->app?->name, 'name')
            ],

            'client_id' => [
                'required',
                'string',
                Rule::unique('zoom_apps', 'client_id')
                    ->ignore($this->app?->client_id, 'client_id')
            ],
            
            'client_secret' => 'required|string'
        ];
    }
}
