<?php

namespace App\Traits;

use App\Library\Criterion;
use Jedrzej\Sortable\SortableTrait;
use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    use SortableTrait;

    /**
     * Builds sort criteria based on model's sortable fields and query parameters.
     *
     * @param Builder $builder query builder
     * @param array $query query parameters
     *
     * @return array
     */
    protected function getCriteria(Builder $builder, array $query)
    {
        $criteria = [];
        foreach ($query as $value) {
            $criterion = Criterion::make($value, $this->_getDefaultSortOrder());
            if ($this->isFieldSortable($builder, $criterion->getField())) {
                $criteria[] = $criterion;
            }
        }

        return $criteria;
    }
}