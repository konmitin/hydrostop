<?php

namespace App\Filters;

use App\Core\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductFilter
 */
class ProductFilter extends Filter
{
    /**
     * Фильтрация по ID
     *
     * @param string $value
     * @return Builder
     */
    protected function id(string $value): Builder
    {
        return $this->builder->where('id', $value);
    }
    /**
     * Фильтрация по названию
     *
     * @param string $value
     * @return Builder
     */
    protected function name(string $value): Builder
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }

    /**
     * Фильтрация по категории
     *
     * @param string $value
     * @return Builder
     */
    protected function category(array $value): Builder
    {
        return $this->builder->whereIn('category_id', $value);
    }
}