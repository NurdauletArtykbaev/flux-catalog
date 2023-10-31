<?php

namespace Nurdaulet\FluxCatalog\Observers;


class CatalogObserver
{
    public function created($catalog)
    {
        $catalog->slug = \TextConverter::translate($catalog->name);
        $catalog->save();
    }

    public function updated($catalog)
    {
        if ($catalog->slug != \TextConverter::translate($catalog->name)) {
            $catalog->slug = \TextConverter::translate($catalog->name);
            $catalog->save();
        }
    }
}
