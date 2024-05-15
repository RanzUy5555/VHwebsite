<?php

namespace App\Http\Requests\Municipality;

use Illuminate\Foundation\Http\FormRequest;

class MunicipalityRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'name' => ['required', 'unique:municipalities,name'],
                'fee' => ['required'],
            ],
            'PUT' => [
                'name' => ['required', \Illuminate\Validation\Rule::unique('municipalities')->ignore($this->municipality)],
                'fee' => ['required'],
            ]
        };

    }

    public function messages()
    {
        return [
            'name.unique' => 'The category has already been exist'
        ];
    }
}