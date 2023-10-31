<?php

namespace Nurdaulet\FluxCatalog\Helpers;


class CatalogSeoOptionHelper
{
    public static function getSortOptions()
    {
        return [
            'cheap' => 'дешевый',
            'expensive' => 'дорогой ',
            'new' => 'новый ',
        ];
    }


    public static function getAdditionalOptions()
    {
        return [
            'hit' => 'Хит',
            'deposit' => 'Под залог',
        ];
    }

}
