<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'title' => 'required|string',
            'summary' => 'required|string',
            'items' => 'required|array',
            'items.*' => 'required|string',
            'pricings' => 'required|array',
            'pricings.*.max_audience' => 'numeric',
            'pricings.*.cost' => 'numeric',
            'pricings.*.discount' => 'numeric'
        ];
    }
}
