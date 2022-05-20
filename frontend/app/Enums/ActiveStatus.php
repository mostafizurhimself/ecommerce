<?php

namespace App\Enums;

/**
 * @method static ActiveStatus INACTIVE()
 * @method static ActiveStatus ACTIVE()
 */
class ActiveStatus extends Enum
{
    private const INACTIVE = 'inactive';
    private const ACTIVE   = 'active';
}
