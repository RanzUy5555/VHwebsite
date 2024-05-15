<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'name' => ['required', \Illuminate\Validation\Rule::unique('services', 'name')],
                'description' => ['required'],
                'image' => ['required'],
            ],
            'PUT' => [
                'name' => ['required',  \Illuminate\Validation\Rule::unique('services')->ignore($this->service)],
                'description' => ['required'],
                'image' => ['sometimes'],
            ]
        };
    }

    public function messages()
    {
        return [
            'name.required' => 'The service field is required',
            'name.unique' => 'Service has already been exist',
            'image.required' => 'The featured photo is required',
        ];
    }
}