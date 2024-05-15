<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'supplier_id' => ['required'],
                'category_id' => ['required'],
                'brand_id' => ['required'],
                'name' => ['required', 'unique:products,name'],
                'description' => ['required'],
                'price' => ['required_without_all:product_variety_name,product_variety_price'],
                'product_variety_name' => ['required_without:price', 'array'],
                'product_variety_price' => ['required_without:price', 'array'],
                'product_variety_qty' => ['required_without:price', 'array'],
                'qty' => ['required_without_all:product_variety_name,product_variety_price,product_variety_qty'],
                'image' => ['required'],
                'is_customized' => ['required', 'boolean'],
            ],
            'PUT' => [
                'option' => ['required_without_all:supplier_id,category_id,brand_id,name,description,is_customized,price,product_variety_name,product_variety_price, product_variety_qty, qty'],
                'supplier_id' => ['required_without:option'],
                'category_id' => ['required_without:option'],
                'brand_id' => ['required_without:option'],
                'name' => ['required_without:option', \Illuminate\Validation\Rule::unique('products', 'name')->ignore($this->product)],
                'description' => ['required_without:option'],
                'price' => ['required_without_all:product_variety_name,product_variety_price,option'],
                'product_variety_name' => ['required_without_all:price,option', 'array'],
                'product_variety_price' => ['required_without_all:price,option', 'array'],
                'product_variety_qty' => ['required_without_all:price,option', 'array'],
                'qty' => ['required_without_all:product_variety_name,product_variety_price,product_variety_qty,option'],
                'is_customized' => ['required_without:option', 'boolean'],
            ],
        };
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'The supplier field is required.',
            'brand_id.required' => 'The brand field is required.',
            'category_id.required' => 'The category field is required.',
            'name.unique' => 'The product has already been exist',
            'price.required_without' => 'The price field is required when variety is not present.',
            'product_variety_name.required_without' => 'The product variety name field is required when individual product price is not present.',
            'product_variety_price.required_without' => 'The  product variety name field is required when individual product price is not present.',
            'option.required_without' => 'The option field is required when there is no input request.',
            'image.required' => 'Please upload at least one product image.'
        ];
    }
}