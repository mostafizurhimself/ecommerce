<?php

namespace App\Models;

use App\Traits\Trashed;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [];
}