<?php

namespace Nurdaulet\FluxCatalog\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Nurdaulet\FluxCatalog\Helpers\PropertyHelper;

class PropertiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'input_type' => PropertyHelper::INPUT_TYPES[$this->input_type],
            'name' => $this->name,
            'values' => ValuesResource::collection($this->whenLoaded('values'))
        ];
    }
}
