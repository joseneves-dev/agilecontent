<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use App\Models\Country;

class User extends Authenticatable
{
  
    use HasFactory, Notifiable, HasApiTokens;
   
    protected $fillable = [
        'name',
        'countryId',
        'isActive',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId', 'id');
    }
    
    protected static function booted()
    {
        static::deleting(function ($user) {
            $user->tokens()->delete();
        });
    }
}
