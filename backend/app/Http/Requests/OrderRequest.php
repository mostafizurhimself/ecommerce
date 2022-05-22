<?php

namespace App\Http\Requests;

use App\Enums\PaymentMethod;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'token'                       => ['sometimes', 'string'],
            'customerId'                  => ['nullable', 'integer'],
            'note'                        => ['nullable', 'max:500'],
            'paymentMethod'               => ['required', 'string', Rule::in(PaymentMethod::toArray())],
            'totalDiscount'               => ['required', 'integer', 'min:0'],
            'orderItems'                  => ['required'],
            'orderItems.*.productId'      => ['required'],
            'orderItems.*.rate'           => ['required', 'numeric', 'min:1'],
            'orderItems.*.quantity'       => ['required', 'numeric', 'min:1'],
            'orderItems.*.amount'         => ['required', 'integer', 'min:1'],
            'orderItems.*.unitId'         => ['required'],

            // Customer Details
            'firstName'                   => ['required_without:customerId', 'string', 'between:2,100'],
            'lastName'                    => ['required_without:customerId', 'string', 'between:2,100'],
            'email'                       => ['required_without:customerId', 'email', 'max:100'],
            'phone'                       => ['required_without:customerId', 'string', 'max:15'],
            'password'                    => ['required_without:customerId', 'nullable', 'confirmed', 'min:6'],
            'billingAddress'              => ['required', 'array'],
            'billingAddress.street'       => ['required_with:billingAddress', 'string', 'max:250'],
            'billingAddress.city'         => ['required_with:billingAddress', 'string', 'max:250'],
            'billingAddress.state'        => ['nullable', 'string', 'max:250'],
            'billingAddress.zipcode'      => ['required_with:billingAddress', 'string', 'max:50'],
            'billingAddress.country'      => ['required_with:billingAddress', 'string', 'max:50'],
            'shippingAddress'             => ['required', 'array'],
            'shippingAddress.street'      => ['required_with:shippingAddress', 'string', 'max:250'],
            'shippingAddress.city'        => ['required_with:shippingAddress', 'string', 'max:250'],
            'shippingAddress.state'       => ['nullable', 'string', 'max:250'],
            'shippingAddress.zipcode'     => ['required_with:shippingAddress', 'string', 'max:50'],
            'shippingAddress.country'     => ['required_with:shippingAddress', 'string', 'max:50'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'billingAddress.street'   => 'Billing Address Street',
            'billingAddress.city'     => 'Billing Address City',
            'billingAddress.state'    => 'Billing Address State',
            'billingAddress.zipcode'  => 'Billing Address Zipcode',
            'billingAddress.country'  => 'Billing Address Country',
            'shippingAddress.street'  => 'Shipping Address Street',
            'shippingAddress.city'    => 'Shipping Address City',
            'shippingAddress.state'   => 'Shipping Address State',
            'shippingAddress.zipcode' => 'Shipping Address Zipcode',
            'shippingAddress.country' => 'Shipping Address Country',
        ];
    }
}