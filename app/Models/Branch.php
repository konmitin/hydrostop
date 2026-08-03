<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'code',
        'address',
        'is_main',
        'map_link',
        'about',
    ];
}
