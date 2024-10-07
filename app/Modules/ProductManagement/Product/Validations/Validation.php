<?php

namespace App\Modules\ProductManagement\Product\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class Validation extends FormRequest
{
    /**
     * Determine if the  is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * validateError to make this request.
     */
    public function validateError($data)
    {
        $errorPayload =  $data->getMessages();
        return response(['status' => 'validation_error', 'errors' => $errorPayload], 422);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validateError($validator->errors()));
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException($this->validateError($validator->errors()));
        }
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_category_group_id' => 'sometimes | required',

            'is_featured' => 'sometimes | required',
            'is_new' => 'sometimes | required',
            'is_available' => 'sometimes | required',
            'is_pre_order' => 'sometimes | required',
            'is_up_coming' => 'sometimes | required',
            'is_emi_support' => 'sometimes | required',

            'type' => 'sometimes | required',
            'title' => 'sometimes | required',
            'short_description' => 'sometimes | required',
            'description' => 'sometimes | required',

            'product_menufecturer_id' => 'sometimes | required',
            'product_brand_id' => 'sometimes | required',
            'sku' => 'sometimes | required',
            'product_unit_id' => 'sometimes | required',

            'alert_quantity' => 'sometimes | required',

            'seller_points' => 'sometimes | required',
            'is_returnable' => 'sometimes | required',
            'expiration_days' => 'sometimes | required',

            'price_type' => 'sometimes | required',

            'purchase_price' => 'sometimes | required',

            'tax_type' => 'sometimes | required',
            'tax_amount' => 'sometimes | required',

            'customer_sales_price' => 'sometimes | required',
            'retailer_sales_price' => 'sometimes | required',
            'minimum_sale_price' => 'sometimes | required',
            'maximum_sale_price' => 'sometimes | required',

            'discount_type' => 'sometimes | required',
            'discount_amount' => 'sometimes | required',

            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}
