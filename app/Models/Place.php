<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'street',
        'city',
        'country',
        'postcode',
        'client_user_id',
        'description',
        'menu',
        'offering',
        'product_limit',
        'condition',
    ];

    protected $casts = [
        'menu' => 'array',
        'offering' => 'array',
    ];
}
