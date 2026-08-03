<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Call extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'comment',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
