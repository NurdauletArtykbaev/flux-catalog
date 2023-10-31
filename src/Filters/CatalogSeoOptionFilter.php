<?php

namespace Nurdaulet\FluxCatalog\Filters;

class CatalogSeoOptionFilter extends ModelFilter
{

    public function sort($value)
    {
        if (empty($value)) {
            return $this;
        }
        return $this->builder->where('sort', $value);
    }

    public function additional($value)
    {
        if (empty($value)) {
            return $this;
        }
        return $this->builder->where('additional', $value);
    }

    public function catalog_id($value)
    {
        if (empty($value)) {
            return $this;
        }
        return $this->builder->where('catalog_id', $value);
    }

    public function price($value)
    {
        if (empty($value)) {
            return $this;
        }
        return $this->builder->where('price', '<=', $value);
    }
}
