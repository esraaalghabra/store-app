<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject,MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected   $fillable = [
        'name',
        'email',
        'password',
        'verify_number',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

        public function getJWTCustomClaims()
    {
        return [];
    }
}
