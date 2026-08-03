<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductFile extends Model
{
    public function product() : BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function file() : BelongsTo {
        return $this->belongsTo(File::class);
    }
}
