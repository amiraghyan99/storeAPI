<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSearch
{

    /**
     * @param Builder|static $query
     * @param string $keyword
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
    }

    /**
     * Get all searchable fields
     *
     * @return array
     */
    public static function getSearchableFields(): array
    {
        $model = new static;

        return $model->searchable_fields ??  $model->getFillable() ?? [];
    }

    /**
     * Get searchable key
     *
     * @return string
     */
    public static function getSearchableKey(): string
    {
        $model = new static;

        return $model->searchable_key ?: 'search';

    }
}
