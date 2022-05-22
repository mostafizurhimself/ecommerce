<?php

namespace App\Models;

use App\Traits\Trashed;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes, Filterable, Trashed;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['type', 'street', 'city', 'state', 'zipcode', 'country'];

    /**
     * Get the owning addressable model.
     */
    public function addressable()
    {
        return $this->morphTo();
    }
}