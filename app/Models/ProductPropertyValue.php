<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPropertyValue extends Model
{
    protected $table = 'product_property_values';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => Property::find($this->property_id)->name
        );
    }
}
