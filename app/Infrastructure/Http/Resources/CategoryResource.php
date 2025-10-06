<?php

namespace App\Infrastructure\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'shortDescription' => $this->short_description,
            'bgClass' => $this->bg_class,
            'image' => $this->image ? asset($this->image) : null, // URL completa
            'sortOrder' => $this->sort_order,
            'isActive' => $this->is_active,
            'isNew' => $this->created_at
                ? Carbon::parse($this->created_at)->gt(now()->subMonths(3))
                : false,
            'parentId' => $this->parent_id,
            'productCount' => $this->product_count ?? 0, // cantidad de productos

            'parent' => $this->whenLoaded('parent', function () {
                return [
                    'id' => $this->parent->id,
                    'name' => $this->parent->name,
                    'slug' => $this->parent->slug,
                ];
            }),
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'createdAt' => $this->created_at?->toDateTimeString(),
            'updatedAt' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
