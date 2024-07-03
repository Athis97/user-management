<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'email',
        'password',
        'location',
        'latitude',
        'longitude',
        'dob',
        'timezone'
    ];

    public function getLocationAttribute($value)
    {
        if ($value) {
            $location = explode(',', $value);
            return [
                'latitude' => $location[0],
                'longitude' => $location[1],
            ];
        }

        return null;
    }

    public function setLocationAttribute($value)
    {
        if (is_array($value) && isset($value['latitude']) && isset($value['longitude'])) {
            $this->attributes['location'] = $value['latitude'] . ',' . $value['longitude'];
        } else {
            $this->attributes['location'] = $value;
        }
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
