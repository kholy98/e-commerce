<?php

namespace App\Http\Resources;

use App\Weight;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'description' => $this->description,
            'description_ar' => $this->description_ar,
            'price' => (float) $this->price,
            'cost' => (float) $this->cost,
            'stock' => $this->stock,
            'sku' => $this->sku,
            'category_id' => $this->category_id,
            'is_active' => $this->is_active,
            'grind_type' => $this->grind_type?->value,
            'grind_type_label' => $this->grind_type?->label(),
            'weight' => (float) $this->weight,
            'weight_label' => Weight::fromKg((float) $this->weight)?->label(),
            'product_details' => [
                'en' => collect($this->product_details ?? [])->map(function ($detail) {
                    return [
                        'title' => $detail['title_en'] ?? '',
                        'value' => $detail['value_en'] ?? '',
                    ];
                })->toArray(),
                'ar' => collect($this->product_details ?? [])->map(function ($detail) {
                    return [
                        'title' => $detail['title_ar'] ?? '',
                        'value' => $detail['value_ar'] ?? '',
                    ];
                })->toArray(),
            ],
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => $this->whenLoaded('media', function () {
                return $this->getMedia('images')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'name' => $media->name,
                        'file_name' => $media->file_name,
                        'mime_type' => $media->mime_type,
                        'size' => $media->size,
                        'url' => $media->getUrl(),

                    ];
                });
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
