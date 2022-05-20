<?php

namespace App\Observers;

use App\Models\Address;

class AddressObserver
{
    /**
     * Handle the Address "created" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function created(Address $address)
    {
        //
    }

    /**
     * Handle the Address "updated" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function updated(Address $address)
    {
        //
    }

    /**
     * Handle the Address "deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function deleted(Address $address)
    {
        //
    }

    /**
     * Handle the Address "restored" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function restored(Address $address)
    {
        //
    }

    /**
     * Handle the Address "force deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function forceDeleted(Address $address)
    {
        //
    }
}
