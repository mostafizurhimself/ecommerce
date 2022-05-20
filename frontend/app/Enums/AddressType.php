<?php

namespace App\Enums;

/**
 * @method static AppearanceType PRESENT_ADDRESS()
 * @method static AppearanceType PERMANENT_ADDRESS()
 * @method static AppearanceType BILLING_ADDRESS()
 * @method static AppearanceType SHIPPING_ADDRESS()
 */


class AddressType extends Enum
{
    private const PRESENT_ADDRESS   = 'present_address';
    private const PERMANENT_ADDRESS = 'permanent_address';
    private const BILLING_ADDRESS   = 'billing_address';
    private const SHIPPING_ADDRESS  = 'shipping_address';
}