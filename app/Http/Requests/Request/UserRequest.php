<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'service_id' => ['required'],
            'company' => ['sometimes'],
            'message' => ['required'],
            'target_date' => ['required'],
            'file_link' => ['required', 'url'],
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'The service field is required',
        ];
    }
}