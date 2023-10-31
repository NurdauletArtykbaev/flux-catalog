<?php

namespace Nurdaulet\FluxCatalog\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Item extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;
    protected $guarded = [];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
