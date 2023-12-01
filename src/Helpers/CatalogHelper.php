<?php

namespace Nurdaulet\FluxCatalog\Helpers;


class CatalogHelper
{
    const TYPE_RENT = 1;
    const TYPE_SELL = 2;

    const TYPES = [
        self::TYPE_RENT => 'rent',
        self::TYPE_SELL => 'sell',
    ];

    public static function getTypes()
    {
        return  [
            self::TYPE_RENT => trans("admin." . self::TYPES[self::TYPE_RENT]),
            self::TYPE_SELL => trans("admin." . self::TYPES[self::TYPE_SELL]),
        ];
    }
}
