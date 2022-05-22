<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Sortable;
use App\Traits\CamelCasing;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model extends BaseModel
{
    use HasFactory, CamelCasing, Sortable;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 25;

    /**
     * Available sortable fields
     *
     * @var array
     */
    public $sortable = ['*'];

    /**
     * Set the default sort citeria
     *
     * @var array
     */
    protected $defaultSortCriteria = ['created_at,desc'];
}