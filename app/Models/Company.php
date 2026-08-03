<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'full_name',
        'inn',
        'kpp',
        'ogrn',
        'okpo',
        'legal_address',
        'actual_address',
    ];
}
