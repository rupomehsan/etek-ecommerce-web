<?php

namespace App\Modules\SalesManagement\SalesEcommerceOrder\Validations;

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

            'order_id' => 'required|sometimes',
            'date' => 'required|sometimes',
            'user_type' => 'required|sometimes',
            'user_id' => 'required|sometimes',
            'is_delivered' => 'required|sometimes',
            'order_status' => 'required|sometimes',
            'user_address_id' => 'required|sometimes',
            'delivery_method' => 'required|sometimes',
            'delivery_address_id' => 'required|sometimes',
            'subtotal' => 'required|sometimes',
            'delivery_charge' => 'required|sometimes',
            'additional_charge' => 'required|sometimes',
            'product_coupon_id' => 'required|sometimes',
            'coupon_discount' => 'required|sometimes',
            'discount' => 'required|sometimes',
            'discount_type' => 'required|sometimes',
            'total' => 'required|sometimes',
            'is_paid' => 'required|sometimes',
            'paid_amount' => 'required|sometimes',
            'paid_status' => 'required|sometimes',
            'payment_id' => 'required|sometimes',
            'payment_method' => 'required|sometimes',
            'product_wearhouse_id' => 'required|sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}
