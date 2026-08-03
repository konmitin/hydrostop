<?php

namespace App\Http\Resources;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class PropertyValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $property = Property::where('id', $this->property_id)->first();

        return [
            'name' => $property->name,
            'property_id' => $property->id,
            'product_id' => $this->product_id,
            'is_hidden' => $this->is_hidden,
            'value' => $this->value,
        ];
    }
}
