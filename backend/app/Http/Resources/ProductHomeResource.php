<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description ?? '',
            'price' => $this->product_variants_min_price ?? 0,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ],
            'brand' => [
                'id' => $this->brand->id,
                'name' => $this->brand->name,
                'slug' => $this->brand->slug,
            ],
            'gender' => [
                'id' => $this->gender->id,
                'name' => $this->gender->name,
                'slug' => $this->gender->slug,
            ],
            'media' => $this->media->map(function ($media) {
                return [
                    'id' => $media->id,
                    'collection_name' => $media->collection_name,
                    'original_url' => $media->getUrl(),
                ];
            }),
        ];
    }
}
