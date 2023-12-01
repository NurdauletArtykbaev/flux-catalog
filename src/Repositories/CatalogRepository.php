<?php

namespace Nurdaulet\FluxCatalog\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Nurdaulet\FluxCatalog\Filters\CatalogSeoOptionFilter;
use Nurdaulet\FluxCatalog\Helpers\CatalogHelper;

class CatalogRepository
{
    public function find($id, $relations = [])
    {
        return config('flux-catalog.models.catalog')::with($relations)->findOrFail($id);
    }

    public function getSeoOptions($filters = [])
    {
        return config('flux-catalog.models.catalog_seo_option')::select(['id', 'sort', 'additional', 'catalog_id', 'price', 'text'])
            ->active()
            ->applyFilters(new CatalogSeoOptionFilter(), $filters)
            ->get();
    }

    public function getPopularCatalog($filters = [])
    {
        return config('flux-catalog.models.popular_catalog')::active()->with('catalog')
            ->limit($filters['limit'] ?? 5)
            ->get();
    }

    public function getLinkCatalog($filters = [])
    {
        return config('flux-catalog.models.link_catalog')::active()->with('catalog')
            ->limit($filters['limit'] ?? 5)
            ->get();
    }

    public function getCatalogForAdminPanel()
    {
        $catalogs = config('flux-catalog.models.catalog')::with(['ancestors' => fn($query) => $query->active()])->orderBy('name->ru')->get();
        foreach ($catalogs as $catalog) {
            $name = $catalog->name;
            if ($catalog->ancestors->count()) {
                $name = '';
                foreach ($catalog->ancestors as $parent) {
                    $name .= $parent->name . '-';
                }
                $name =  $name . $catalog->name;
            }
            $catalog->name = $name;
        }
        $catalogs = $catalogs->sortBy('name');
        return $catalogs->pluck('name','id')->toArray();
    }

    public function list($cityId = null)
    {
        return config('flux-catalog.models.catalog')::withRecursiveQueryConstraint(function (Builder $query) {
            $query->where('catalogs.is_active',1);
        }, function () use ($cityId) {
            return config('flux-catalog.models.catalog')::tree()
                ->orderBy('lft')
                ->when(config('flux-catalog.options.use_list_items_count'), function($query) use ($cityId) {
                    return $query->withCount([
                        'items' => fn($query) => $query->when($cityId, fn($query) => $query->whereHas('cities', fn($query) => $query->where('cities.id', $cityId)))
                            ->active()
                    ]);
                })
                ->active()
                ->get()
                ->toTree();
        });
    }
    public function mainList($filters = [])
    {
        return config('flux-catalog.models.catalog')::whereNull('parent_id')
            ->when(isset($filters['type']), function ($query) use ($filters) {
                $type = null;
                foreach (CatalogHelper::TYPES as $key => $itemType) {
                    if ($itemType == $filters['type']) {
                        $type = $key;
                    }
                }
                return $query->where('type', $type);
            })
            ->where('catalogs.is_active',1)->get();
    }
    public function descendantsAndSelfIds($id)
    {
        return config('flux-catalog.models.catalog')::with('descendantsAndSelf')
            ->findOrFail($id)
            ->descendantsAndSelf->pluck('id')->toArray();
    }

    public function descendantsAndSelfIdsBySlug($slug)
    {
        return config('flux-catalog.models.catalog')::with('descendantsAndSelf')->whereSlug($slug)->firstOrFail()
            ->descendantsAndSelf->pluck('id')->toArray();
    }

}
