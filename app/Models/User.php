<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["customer", "seller", "admin"][$value],
        );
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }


    public function getMembershipYearsAttribute()
    {
        $currentDate = Carbon::now();
        $membershipStart = $this->created_at;

        $membershipDuration = $membershipStart->diff($currentDate);

        if( ($membershipDuration->y) > 0 )
        {
            return $membershipDuration->y.' Yıldır Üye';
        }
        elseif( ($membershipDuration ->m) > 0)
        {
            return $membershipDuration->m.' Aydır Üye';
        }
        else
        {
            return $membershipDuration->d.' Gündür Üye';
        }
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
