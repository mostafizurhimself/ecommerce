<?php

namespace App\Models;

use App\Traits\Trashed;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes, Filterable, Trashed;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [];
}
