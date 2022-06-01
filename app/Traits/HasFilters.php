<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{

    /**
     * Get all searchable fields
     *
     * @return array
     */
    public static function getSearchableFields(): array
    {
        $model = new static;

        return $model->searchable_fields ?? $model->getFillable() ?? [];
    }

    /**
     * Get searchable key
     *
     * @return string
     */
    public static function getSearchableKey(): string
    {
        $model = new static;
        return $model->searchable_key ?? 'search';

    }

    /**
     * Get all ordered fields
     *
     * @return array
     */
    public static function getOrderedFields(): array
    {
        $model = new static;

        return $model->ordered_fields ?? $model->getFillable() ?? [];
    }

    /**
     * @param Builder $query
     * @param array $data
     * @param boolean $matchAllFields
     * @return void
     */
    public static function scopeSearch(Builder $query, array $data, bool $matchAllFields = false)
    {
        $query->when($data[static::getSearchableKey()] ?? null, function ($query, $keyword) use ($matchAllFields) {
            $query->where(function ($query) use ($keyword, $matchAllFields) {
                foreach (static::getSearchableFields() as $field) {
                    if ($matchAllFields) {
                        $query->where($field, 'LIKE', "%$keyword%");
                    } else {
                        $query->orWhere($field, 'LIKE', "%$keyword%");
                    }
                }
            });
        });

        $query->when((array_key_exists('sortBy', $data) && in_array($data['sortBy'], ['asc', 'desc'])) ?? null, function ($query) use ($data) {
            foreach (static::getOrderedFields() as $orderedField) {
                $query->orderBy($orderedField, $data['sortBy']);
            }
        });
    }


}
