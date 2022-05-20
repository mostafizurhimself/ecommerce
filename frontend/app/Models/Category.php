<?php

namespace App\Models;

use App\Traits\Trashed;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements HasMedia
{
    use SoftDeletes, Filterable, InteractsWithMedia, Trashed;

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
    protected $fillable = ['name', 'description'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['primaryMediaUrl'];

    /**
     * Register the media collections
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('primary')
            ->singleFile();
    }

    /**
     * Get the primary media
     */
    public function getPrimaryMediaUrlAttribute()
    {
        return $this->getFirstMediaUrl('primary') ?? null;
    }

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}