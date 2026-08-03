<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sertificate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'position',
        'type'
    ];


    public function preview(): BelongsTo
    {
        return $this->belongsTo(File::class, 'preview_id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
