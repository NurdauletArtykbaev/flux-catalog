<?php

namespace Nurdaulet\FluxCatalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nurdaulet\FluxItems\Models\Item;
use Spatie\Translatable\HasTranslations;

class Property extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = [
        "name",
        "description",
        "input_type",
        "is_active",
    ];
    public $translatable = ['name'];

    public function values()
    {
        return $this->belongsToMany(Value::class, 'property_value');
    }

    public function catalogs()
    {
        return $this->belongsToMany(Catalog::class, 'catalog_property','property_id','catalog_id');
    }
}
