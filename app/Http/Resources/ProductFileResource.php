<?php

namespace App\Http\Resources;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $file = $this->file()->first();

        return [
            'id' =>  $this->id,
            'name' =>  $this->name,
            'file_id' =>  $this->file_id,
            'position' => $this->position,
            'product_id' => $this->product_id,
            'type' => $this->type,
            'path' => '/storage/' . $file->path,
            'mime' => $file->mime,
        ];
    }
}
