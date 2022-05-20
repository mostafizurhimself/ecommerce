<?php

namespace App\Models;

use App\Traits\Trashed;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLog extends Model
{
    use SoftDeletes, Filterable, Trashed;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['orderId', 'orderItemId', 'action', 'attribute', 'old_value', 'new_value', 'description'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['dateFormatted'];

    /**
     * Get date as formated
     */
    public function getDateFormattedAttribute()
    {
        return $this->createdAt->format('d M, Y h:i A');
    }
}