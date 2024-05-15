<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
        return match($this->method()) {
            'POST' => [
                'company' => ['required', 'unique:suppliers,company'],
                'manager' => ['required'],
                'contact' => ['required', 'digits:11'],
                'email' => ['required', 'unique:suppliers,email'],
            ],
            'PUT' => [
                'company' => ['required', \Illuminate\Validation\Rule::unique('suppliers')->ignore($this->supplier)],
                'manager' => ['required'],
                'contact' => ['required', 'digits:11'],
                'email' => ['required', \Illuminate\Validation\Rule::unique('suppliers')->ignore($this->supplier)],
            ],
        };
    }

    public function messages()
    {
        return [
            'company.unique' => 'Company has already been exist.',
            'email.unique' => 'Email has already been exist.',
        ];
    }
}