<?php

namespace App\Http\Resources;

use App\Models\ProductFile;
use App\Models\ProductPropertyValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $frontImage = $this->frontImage()->first();
        $frontAr = [];

        if ($frontImage) {
            $frontAr = [
                'id' => $frontImage->id,
                'path' => "/storage/" . $frontImage->path,
                'type' => $frontImage->pivot->type,
                'mime' => $frontImage->mime,
            ];
        }

        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'name' => $this->name,
            'seo_name' => $this->seo_name,
            'seo_description' => $this->seo_description,
            'images' => ProductFileResource::collection(ProductFile::where('product_id', $this->id)->where('type', 'image')->orderBy('position')->get()),
            'documents' => ProductFileResource::collection(ProductFile::where('product_id', $this->id)->where('type', 'document')->orderBy('position')->get()),
            'frontImage' => $frontAr,
            'price' => $this->price,
            'unit' => $this->unit()->first(),
            'count' => $this->count,
            'sku' => $this->sku,
            'slug' => $this->slug,
            'description' => $this->description,
            'position' => $this->position,
            'rate' => $this->rate,
            'status' => $this->status()->first(),
            'branch' => $this->branch()->first(),
            'properties' => PropertyValueResource::collection(ProductPropertyValue::where('product_id', $this->id)->get()),
            'category' => $this->category()->first(),
        ];
    }
}
