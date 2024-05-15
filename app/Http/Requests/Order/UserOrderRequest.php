<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UserOrderRequest extends FormRequest
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
            'product_id' => ['sometimes', 'array'],
            'product_id.*' => ['sometimes'],
            'product_variety_id' => ['sometimes', 'array'],
            'product_variety_id.*' => ['sometimes'],
            'qty' => ['required_without:product_variety_qty', 'array'],
            'qty.*' => ['required_without:product_variety_qty'],
            'product_variety_qty' => ['required_without:qty', 'array'],
            'product_variety_qty.*' => ['required_without:qty'],
            'address' => ['required'],
            'municipality_id' => ['required'],
            'contact' => ['required', 'digits:11'],
            'payment_method_id' =>  ['required'],
            'reference_no' => ['required'],
            'image' =>  ['required'],
            'note' => ['sometimes'],
        ];
    }

    public function messages()
    {
        return [
            'municipality_id.required' => 'The municipality field is required',
            'payment_method_id.required' => 'The payment method field is required',
            'image.required' => 'Please upload a screenshot of your payment receipt from your selected payment method',
        ];
    }
}