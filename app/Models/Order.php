<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'number',
        'amount',
        'email',
        'delivery_at',
    ];

    public function client() : BelongsTo {
        return $this->belongsTo(Client::class);
    }

    public function branch() : BelongsTo {
        return $this->belongsTo(Branch::class);
    }
}
