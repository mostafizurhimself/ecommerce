<?php

namespace App\Traits;

use App\Models\Address;

trait InteractsWithAddress
{
    /**
     * Get the supplier address
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function address()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Set billing address
     * 
     * @param array $address
     */
    public function setAddress($address, $type)
    {
        $this->address()->updateOrCreate(
            [
                'type' => $type,
            ],
            [
                'street'    => $address['street'],
                'city'      => $address['city'],
                'state'     => $address['state'] ?? null,
                'zipcode'   => $address['zipcode'] ?? null,
                'country'   => $address['country'],
            ]
        );
    }
}