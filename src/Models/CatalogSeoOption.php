<?php

namespace Nurdaulet\FluxCatalog\Models;

use Nurdaulet\FluxCatalog\Traits\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogSeoOption extends Model
{
    use HasFactory, HasFilters;

    protected $guarded = [];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
