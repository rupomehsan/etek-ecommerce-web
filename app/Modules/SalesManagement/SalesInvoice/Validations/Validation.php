<?php

namespace App\Modules\SalesManagement\SalesInvoice\Validations;

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
            'product_wearhouse_id' => 'required | sometimes',
            'customer_id' => 'required | sometimes',
            'product_id' => 'required | sometimes',
            'date' => 'required | sometimes',
            'order_id' => 'required | sometimes',
            'discount_on_all' => 'required | sometimes',
            'discount_on_all_type' => 'required | sometimes',
            'is_quotation' => 'required | sometimes',
            'is_order' => 'required | sometimes',
            'is_invoiced' => 'required | sometimes',
            'is_delivered' => 'required | sometimes',
            'is_paid' => 'required | sometimes',
            'order_type' => 'required | sometimes',
            'order_status' => 'required | sometimes',
            'total' => 'required | sometimes',
            'subtotal' => 'required | sometimes',
            'paid_amount' => 'required | sometimes',
            'source' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}
