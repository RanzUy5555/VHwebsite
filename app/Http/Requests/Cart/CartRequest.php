<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'product_id' => ['required_if:product_variety_id,null'],
            'product_variety_id' => ['required_if:product_id,null'],
            'qty' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'product_id.unique' => 'The product has already been added to your cart. Please select another one.',
            'product_variety_id.unique' => 'The product has already been added to your cart. Please select another one.',
        ];
    }
}