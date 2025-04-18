<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category' => 'required|string|max:255',
            'new_category' => 'required_if:category,new|string|max:255',
            'product_name' => 'required|string|max:255',
            'brand_model' => 'required|string|max:255',
            'new_brand_model' => 'required_if:brand_model,new|string|max:255',
            'serial_number' => 'required|string|max:255|unique:products,serial_number',
            'supplier_name' => 'required|string|max:255',
            'new_supplier' => 'required_if:supplier_name,new|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Please select or enter a category',
            'new_category.required_if' => 'Please enter a new category name',
            'brand_model.required' => 'Please select or enter a brand/model',
            'new_brand_model.required_if' => 'Please enter a new brand/model name',
            'supplier_name.required' => 'Please select or enter a supplier',
            'new_supplier.required_if' => 'Please enter a new supplier name',
            'serial_number.unique' => 'This serial number is already in use',
        ];
    }
}
