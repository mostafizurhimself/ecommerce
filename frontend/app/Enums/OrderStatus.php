<?php

namespace App\Enums;

/**
 * @method static OrderStatus PENDING()
 * @method static OrderStatus APPROVED()
 * @method static OrderStatus PROCESSING()
 * @method static OrderStatus SHIPPED()
 * @method static OrderStatus DELIVERED()
 * @method static OrderStatus CANCELED()
 */
class OrderStatus extends Enum
{
    private const PENDING    = 'pending';
    private const APPROVED   = 'approved';
    private const PROCESSING = 'processing';
    private const SHIPPED    = 'shipped';
    private const DELIVERED  = 'delivered';
    private const REJECTED   = 'rejected';
    private const CANCELED   = 'canceled';
}