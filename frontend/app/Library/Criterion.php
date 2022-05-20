<?php

namespace App\Library;

use Illuminate\Support\Str;
use Jedrzej\Sortable\Criterion as Base;
use Illuminate\Database\Eloquent\Builder;

class Criterion extends Base
{
    /**
     * Applies criterion to query.
     *
     * @param Builder $builder query builder
     */
    public function apply(Builder $builder)
    {
        $sortMethod = 'sort' . Str::studly($this->getField());

        if (method_exists($builder->getModel(), $sortMethod)) {
            call_user_func_array([$builder->getModel(), $sortMethod], [$builder, $this->getOrder()]);
        } else {
            $builder->orderBy(Str::snake($this->getField()), $this->getOrder());
        }
    }
}
