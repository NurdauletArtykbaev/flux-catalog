<?php

namespace Nurdaulet\FluxCatalog\Http\Controllers;

use Nurdaulet\FluxCatalog\Http\Resources\CatalogResource;
use Nurdaulet\FluxCatalog\Services\CatalogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CatalogController
{

    public function __construct(private CatalogService $catalogService)
    {
    }

    public function index(Request $request)
    {

        $cityId = $request->header('city_id');
        $lang = app()->getLocale();

        return Cache::remember("catalogs-city-$cityId-$lang", config('flux-catalog.options.cache_expiration', 3600), function () use ($cityId) {
            return CatalogResource::collection($this->catalogService->list($cityId));
        });
    }

    public function mainList(Request $request)
    {
        $lang = app()->getLocale();
        $filters = $request->input('filters', []);
        return Cache::remember("main-catalogs-city-$lang-" . json_encode($filters), config('flux-catalog.options.cache_expiration', 3600), function () use ($filters) {
            return CatalogResource::collection($this->catalogService->mainList($filters));
        });
    }


    public function popular(Request $request)
    {
        $lang = app()->getLocale();
        $filters = $request->input('filters');

        return Cache::remember("popular-catalogs-$lang", config('flux-catalog.options.cache_expiration', 3600), function () use ($filters) {
            return CatalogResource::collection($this->catalogService->getPopularCatalogs($filters));
        });
    }

    public function links(Request $request)
    {
        $lang = app()->getLocale();
        $filters = $request->input('filters');

        return Cache::remember("link-catalogs-$lang", config('flux-catalog.options.cache_expiration', 3600), function () use ($filters) {
            return CatalogResource::collection($this->catalogService->getLinkCatalogs($filters));
        });
    }

    public function seoOptions(Request $request)
    {
        $filters = $request->input('filters', []);
        $lang = app()->getLocale();
        return Cache::remember("catalog-seo-options-" . json_encode($filters) . $lang, config('flux-catalog.options.cache_expiration', 3600), function () use ($filters) {
            return response()->json(['data' => $this->catalogService->getSeoOptions($filters)]);
        });
    }
}
