<?php

namespace App\Console\Commands;

use App\Enums\AddressType;
use App\Models\Order;
use App\Models\Delivery;
use App\Enums\OrderStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveDelivered extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'move:delivered';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move delivered orders to delivery table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('status', OrderStatus::DELIVERED())->get();
        foreach ($orders as $order) {
            DB::transaction(function () use ($order) {
                $delivery = Delivery::create($order->only(['invoiceNo', 'customerId', 'grandTotal', 'note', 'paymentMethod']));

                foreach ($order->orderItems as $item) {
                    $delivery->deliveryItems()->create($item->only(['productId', 'quantity', 'rate', 'unitId', 'amount']));
                }

                // Set Address
                $delivery->setAddress($order->billingAddress->toArray(), AddressType::BILLING_ADDRESS());
                $delivery->setAddress($order->shippingAddress->toArray(), AddressType::SHIPPING_ADDRESS());

                $order->delete();
                $order->address()->delete();
                $this->info("{$delivery->invoiceNo} is moved to deliveries table successfully.");
            });
        }
    }
}