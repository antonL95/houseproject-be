<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ClientUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, MustVerifyEmail;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'var_number',
        'street',
        'city',
        'country',
        'postcode',
        'email_verified_at',
        'password',
        'google_id',
        'facebook_id',
        'apple_id',
        'profile_image',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_id',
        'facebook_id',
        'apple_id',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
