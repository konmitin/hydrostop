<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $file = new FileResource($this->file()->first());
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'position' => $this->position,
            'file' => $file,
            'preview' => new FileResource($this->preview()->first()),
        ];
    }
}
