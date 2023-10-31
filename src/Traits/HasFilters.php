<?php

namespace Nurdaulet\FluxCatalog\Traits;

use Nurdaulet\FluxCatalog\Filters\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function scopeApplyFilters(Builder $builder, ModelFilter $modelFilter, array $filters): Builder
    {
        return $modelFilter->apply($builder, $filters);
    }
}
