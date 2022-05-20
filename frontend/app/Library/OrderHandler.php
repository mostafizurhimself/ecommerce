<?php

namespace App\Library;

use App\Enums\PaymentMethod;
use App\Traits\CreateCustomer;
use App\Traits\InteractsWithOrder;

class OrderHandler
{
    use CreateCustomer, InteractsWithOrder;

    /**
     * Payment method of the order
     *
     * @var string
     */
    private $paymentMethod;

    /**
     * Set the payment method
     *
     * @param \App\Enums\PaymentMethod $paymentMethod
     */
    public function __construct($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Charge payment from the gateway
     *
     * @param int    $amount
     * @param string $currency
     * @param string $token
     * @param string $description
     * @param int    $orderId
     */
    public function charge($request, $order, $currency)
    {
        if ($this->paymentMethod == PaymentMethod::STRIPE()) {
            $this->chargeFromStripe($order->grandTotal, $currency, $request->token, "Order {$order->id} from sabziwala");
        }

        if ($this->paymentMethod == PaymentMethod::WALLET()) {
            $this->chargeFromWallet($request, $order);
        }
    }

    /**
     * Charge for stripe payment gateway
     *
     * @param int    $amount
     * @param string $currency
     * @param string $token
     * @param string $description
     */
    public function chargeFromStripe($amount, $curreny, $token, $description)
    {
        // Charge by stripe
    }

    /**
     * Charge charge from the wallet
     *
     * @param int  $amount
     * @param int  $orderId
     */
    public function chargeFromWallet($request, $order)
    {
        // Charge from wallet
    }
}