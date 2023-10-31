<?php

namespace Nurdaulet\FluxCatalog\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CatalogResource extends JsonResource
{
    public function toArray($request)
    {
        $ifUseListItemsCount = config('flux-catalog.options.use_list_items_count');
        if ($ifUseListItemsCount) {

            $itemsCount = $this->children
                    ->map(fn($item) => $item->children?->map(fn($itemChild) => $itemChild->children?->pluck('items_count')
                                ->sum() + $itemChild->items_count)
                            ->sum() + $item->items_count
                    )->sum() + $this->items_count;
        }

        return [
            'id' => $this->id,
            'image' => $this->image ? config('filesystems.disks.s3.url') . '/' . $this->image : null,
            'name' => $this->name,
            'seo_title' => $this->seo_title,
            'seo_text' => $this->seo_text,
            'is_first_place' => $this->is_first_place,
            'childs' => self::collection($this->whenLoaded('children', function () use ($ifUseListItemsCount) {

                if ($ifUseListItemsCount) {
                    if ($this->level == 0) {
                        return $this->children->filter(fn($child) => $child->children->count() > 0 || $child->items_count > 0);
                    }
                    return $this->children->where('items_count', '>', 0);
                }
                return $this->children;
            })),

            'childs_count' => $this->whenLoaded('children', function () {
                return  $this->children->count();
            }),
            'slug' => $this->slug,
            'origin_items_count' => $this->whenHas('items_count', $this->items_count),
            'items_count' => $this->when($ifUseListItemsCount, $itemsCount ?? 0),
        ];
    }
}
