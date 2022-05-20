<?php

namespace App\Traits;

use App\Models\Customer;
use App\Enums\AddressType;

trait CreateCustomer
{
    /**
     * Create a new customer for the order
     *
     * @param \App\Http\Requests\OrderRequest $request
     * @return \App\Models\Customer
     */
    public function createCustomer($request)
    {
        $customer = Customer::create(array_merge(
            $request->only('firstName', 'lastName', 'email', 'phone'),
            ['password' => bcrypt($request->password)]
        ));

        // Set billing address
        if (!empty($request->billingAddress)) {
            $customer->setAddress($request->billingAddress, AddressType::BILLING_ADDRESS());
        }

        // Set shipping address
        if (!empty($request->shippingAddress)) {
            $customer->setAddress($request->shippingAddress, AddressType::SHIPPING_ADDRESS());
        }

        return $customer->id;
    }
}