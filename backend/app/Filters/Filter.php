<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class Filter extends ModelFilter
{
    /**
     * Searchable columns of the table
     *
     * @var array
     */
    public $searchColumns = [];

    /**
     * Related table searchable columns
     *
     * @var array
     */
    public $searchRelations = [];

    /**
     * Search Filter
     */
    public function search($search)
    {
        // Search columns
        $this->where(function ($query) use ($search) {
            foreach ($this->searchColumns as $column) {
                $query->orWhere($column, "LIKE", "%$search%");
            }

            // Search Relations
            foreach ($this->searchRelations as $relation => $columns) {
                $query->orWhereHas($relation, function ($query) use ($columns, $search) {
                    $query->where(function ($query) use ($columns, $search) {
                        foreach ($columns as $column) {
                            $query->orWhere($column, "LIKE", "%$search%");
                        }
                    });
                });
            }
        });
    }
}