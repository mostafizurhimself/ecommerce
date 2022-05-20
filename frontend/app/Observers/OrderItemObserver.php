<?php

namespace App\Observers;

use App\Models\OrderLog;
use App\Models\OrderItem;

class OrderItemObserver
{
    /**
     * Handle the OrderItem "created" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function created(OrderItem $orderItem)
    {
        //
    }

    /**
     * Handle the OrderItem "updated" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function updated(OrderItem $orderItem)
    {
        if ($orderItem->isDirty('quantity')) {
            OrderLog::create([
                'orderId'     => $orderItem->orderId,
                'orderItemId' => $orderItem->id,
                'action'      => "updated",
                'attribute'   => "quantity",
                'old_value'   => $orderItem->getOriginal('quantity'),
                'new_value'   => $orderItem->quantity,
                'description' => "{$orderItem->product->name} quantity changed from " . $orderItem->getOriginal('quantity') . " to " . $orderItem->quantity,
            ]);
        }

        if ($orderItem->isDirty('amount')) {
            OrderLog::create([
                'orderId'     => $orderItem->orderId,
                'orderItemId' => $orderItem->id,
                'action'      => "updated",
                'attribute'   => "amount",
                'old_value'   => $orderItem->getOriginal('amount'),
                'new_value'   => $orderItem->amount,
                'description' => "{$orderItem->product->name} amount changed from " . $orderItem->getOriginal('amount') . " to " . $orderItem->quantity,
            ]);
        }
    }

    /**
     * Handle the OrderItem "deleting" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function deleting(OrderItem $orderItem)
    {
        OrderLog::create([
            'orderId'     => $orderItem->orderId,
            'orderItemId' => $orderItem->id,
            'action'      => "deleted",
            'description' => "{$orderItem->product->name}($orderItem->id) was deleted",
        ]);
    }

    /**
     * Handle the OrderItem "restored" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function restored(OrderItem $orderItem)
    {
        //
    }

    /**
     * Handle the OrderItem "force deleted" event.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return void
     */
    public function forceDeleted(OrderItem $orderItem)
    {
        //
    }
}