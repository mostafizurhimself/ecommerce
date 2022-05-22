<?php

namespace App\Models;

use App\Traits\Trashed;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryItem extends Model
{
    use SoftDeletes, Filterable, Trashed;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['deliveryId', 'productId', 'quantity', 'rate', 'unitId', 'amount'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['amountFormatted', 'rateFormatted'];

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the rate as formated
     */
    public function getRateFormattedAttribute()
    {
        $value = new Money(ceil($this->rate), new Currency("BDT"), true);
        return $value->formatWithoutZeroes();
    }

    /**
     * Get the amount as formated
     */
    public function getAmountFormattedAttribute()
    {
        $value = new Money(ceil($this->amount), new Currency("BDT"), true);
        return $value->formatWithoutZeroes();
    }
}