<?php

namespace App\Filters;

class CategoryFilter extends Filter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $searchRelations = [];

    /**
     * Searchable columns of the table
     *
     * @var array
     */
    public $searchColumns = ['name', 'description'];
}