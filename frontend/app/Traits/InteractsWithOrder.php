<?php

namespace App\Traits;

use App\Enums\AddressType;
use App\Models\Order;

trait InteractsWithOrder
{
    /**
     * Create a new order with given data
     *
     * @param \App\Http\Requests\OrderRequest $request
     * @return \App\Models\Order
     */
    public function createOrder($request)
    {
        $customerId = $request->customerId ?? $this->createCustomer($request);

        $order = Order::create([
            'customerId'         => $customerId,
            'totalDiscount'      => $request->totalDiscount,
            'note'               => $request->note,
            'paymentMethod'      => $request->paymentMethod
        ]);

        foreach ($request->orderItems as $item) {
            $order->orderItems()->create(
                [
                    'productId'        => $item['productId'],
                    'rate'             => $item['rate'],
                    'unitId'           => $item['unitId'],
                    'quantity'         => $item['quantity'],
                    'amount'           => $item['amount'],
                ]
            );
        }

        // Update totals
        $order->updateTotals();

        // Set billing address
        if (!empty($request->billingAddress)) {
            $order->setAddress($request->billingAddress, AddressType::BILLING_ADDRESS());
        }

        // Set shipping address
        if (!empty($request->shippingAddress)) {
            $order->setAddress($request->shippingAddress, AddressType::SHIPPING_ADDRESS());
        }

        return $order;
    }

    /**
     * Update the order
     *
     * @param \App\Models\Order               $order
     * @param \App\Http\Requests\OrderRequest $request
     * @return \App\Models\Order
     */
    public function updateOrder(Order $order, $request)
    {
        $items = collect($request->input('orderItems'));
        if (isset($items->pluck('id')[0])) {
            $order->orderItems()->whereNotIn('id', $items->pluck('id')->reject(function ($id) {
                return empty($id);
            }))->delete();
        } else {
            $order->orderItems()->delete();
        }

        $items->each(function ($item) use ($order) {
            $order->orderItems()->updateOrCreate(
                [
                    'id' => $item['id'] ?? null
                ],
                [
                    'quantity' =>  $item['quantity'],
                    'amount'   =>  $item['amount']
                ]
            );
        });

        // Update totals
        $order->updateTotals();

        return $order;
    }
}