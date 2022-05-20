<?php

namespace App\Models;

use App\Traits\Trashed;
use Akaunting\Money\Money;
use Akaunting\Money\Currency;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasMedia
{
    use SoftDeletes, Filterable, Trashed, InteractsWithMedia;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['categoryId', 'name', 'sku', 'description', 'price', 'quantity', 'unitId'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ["priceFormatted", "imageUrl"];

    /**
     * Register the media collections
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-photo')->singleFile();
    }

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the sale price as formatted
     */
    public function getPriceFormattedAttribute()
    {
        $value = new Money(ceil($this->price), new Currency("BDT"), true);
        return $value->formatWithoutZeroes();
    }

    /**
     * Get the image url
     */
    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('product-photo') ?? null;
    }
}