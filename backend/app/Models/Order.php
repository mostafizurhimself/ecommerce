<?php

namespace App\Models;

use App\Traits\Trashed;
use Akaunting\Money\Money;
use App\Enums\AddressType;
use App\Traits\HasInvoiceNo;
use Akaunting\Money\Currency;
use EloquentFilter\Filterable;
use App\Traits\InteractsWithAddress;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, Filterable, Trashed, HasInvoiceNo, InteractsWithAddress;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['invoiceNo', 'customerId', 'grandTotal', 'status', 'note', 'paymentMethod'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['dateFormatted', 'grandTotalFormatted', 'subTotalFormatted', 'totalDiscountFormatted'];

    /**
     * Set the model readable id length
     *
     * @var int
     */
    protected static $invoiceNoLength = 5;

    /**
     * Set the model readable id prefix
     *
     * @var string
     */
    public static function invoiceNoPrefix()
    {
        return "WE";
    }

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderLogs()
    {
        return $this->hasMany(OrderLog::class);
    }

    /**
     * Scope a query to only the logged in custoemr.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCustomer($query)
    {
        return $query->where('customer_id', auth()->user()->id);
    }

    /**
     * Update order totals
     */
    public function updateTotals()
    {
        $this->subTotal   = $this->orderItems()->sum('amount');
        $this->grandTotal = $this->subTotal - $this->totalDiscount;
        $this->save();
    }

    /**
     * Update products quantity
     */
    public function updateProductsQuantity()
    {
        foreach ($this->orderItems as $item) {
            $item->product->decrement('quantity', $item->quantity);
        }
    }

    /**
     * Get date as formated
     */
    public function getDateFormattedAttribute()
    {
        return $this->createdAt->format('d M, Y h:i A');
    }

    /**
     * Get billing address attribute
     *
     * @return mixed
     */
    public function getBillingAddressAttribute()
    {
        if ($this->address) {
            return $this->address->where('type', AddressType::BILLING_ADDRESS())->first();
        }
    }

    /**
     * Get shipping address attribute
     *
     * @return mixed
     */
    public function getShippingAddressAttribute()
    {
        if ($this->address) {
            return $this->address->where('type', AddressType::SHIPPING_ADDRESS())->first();
        }
    }

    /**
     * Get the order sub total formatted
     */
    public function getSubTotalFormattedAttribute()
    {
        $value = new Money(ceil($this->subTotal), new Currency("BDT"), true);
        return $value->formatWithoutZeroes();
    }

    /**
     * Get the order total discount formatted
     */
    public function getTotalDiscountFormattedAttribute()
    {
        $value = new Money(ceil($this->totalDiscount), new Currency("BDT"), true);
        return $value->formatWithoutZeroes();
    }

    /**
     * Get the order grand total formatted
     */
    public function getGrandTotalFormattedAttribute()
    {
        $value = new Money(ceil($this->grandTotal), new Currency("BDT"), true);
        return $value->formatWithoutZeroes();
    }
}