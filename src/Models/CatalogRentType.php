<?php

namespace Nurdaulet\FluxCatalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogRentType extends Model
{
    use HasFactory;
    protected $guarded = [ ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function rentType()
    {
        return $this->belongsTo(RentType::class);
    }


}
