<?php

namespace App\Filters;

class DeliveryFilter extends Filter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $searchRelations = [
        "customer" => ['first_name', 'last_name']
    ];

    /**
     * Searchable columns of the table
     *
     * @var array
     */
    public $searchColumns = ['invoice_no', 'grand_total',  'created_at'];
}