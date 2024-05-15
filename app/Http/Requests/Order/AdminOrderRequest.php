<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class AdminOrderRequest extends FormRequest
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
            'status' => ['required'],
            'remark' => ['required_if:status,2,5']
        ];
    }

    public function messages()
    {
        return [
            'remark.required_if' => 'The remark is required when you attempt to reject or cancel an order.',
        ];
    }
}