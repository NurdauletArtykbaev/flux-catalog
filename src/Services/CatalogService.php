<?php

namespace Nurdaulet\FluxCatalog\Services;

use Nurdaulet\FluxCatalog\Repositories\CatalogRepository;

class CatalogService
{
    public function __construct(private readonly CatalogRepository $catalogRepository)
    {
    }

    public function list($cityId = null)
    {
        return $this->catalogRepository->list($cityId);
    }
    public function mainList()
    {
        return $this->catalogRepository->mainList();
    }

    public function getSeoOptions($filters = [])
    {
        return $this->catalogRepository->getSeoOptions($filters);
    }

    public function getPopularCatalogs($filters = [])
    {

        return $this->catalogRepository->getPopularCatalog($filters);
    }

    public function getLinkCatalogs($filters = [])
    {

        return $this->catalogRepository->getLinkCatalog($filters);
    }
}
