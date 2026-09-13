<?php

namespace App\Models;

use App\Core\Traits\HasFilter;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFilter;
    
    protected $guarded = [
        'status',
        'branch',
        'category',
        'unit',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'product_property_values');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function frontImage(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'product_files')->withPivot(['type', 'name'])->wherePivot('type', 'front');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'product_files')->withPivot(['type', 'name', 'position'])->wherePivot('type', 'image');
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'product_files')->withPivot(['type', 'name', 'position'])->wherePivot('type', 'document');
    }

    #[Scope]
    protected function ordered(Builder $query) : void {
        $query->orderBy('position', 'ASC')->orderBy('id', 'DESC');
    }
}
