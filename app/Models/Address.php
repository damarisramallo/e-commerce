<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'address',
        'city',
        'reference',
        'receiver',
        'receiver_info',
        'is_default',
    ];

    protected $casts = [
        'receiver_info' => 'array',
        'is_default' => 'boolean',
    ];
}
