<?php

namespace Nurdaulet\FluxCatalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkCatalog extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
