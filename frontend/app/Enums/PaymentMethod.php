<?php

namespace App\Enums;

/**
 * @method static PaymentMethod COD()
 * @method static PaymentMethod STRIPE()
 * @method static PaymentMethod BKASH()
 * @method static PaymentMethod NAGAD()
 * @method static PaymentMethod WALLET()
 */
class PaymentMethod extends Enum
{
    private const COD    = 'cod';
    private const STRIPE = 'stripe';
    private const BKASH  = 'bkash';
    private const NAGAD  = 'nagad';
    private const WALLET = 'wallet';
}