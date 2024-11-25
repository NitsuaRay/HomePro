<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Personnel extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'personnel';
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'extra_add',
        'photo',
        'gender',
        'service_cat',
        'fee',
        'age',
        'earning',
        'extra_fee',
        'isVerified',
        'id_picture',
        'isGCash',
        'updated_at_earning',
        'description',
        'birthday',
        'extra_add_picture',
        'nbiClearance',
        'accepted_terms',
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

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'personnel_id');
    }

    public function cancels()
    {
        return $this->hasMany(Cancel::class);
    }
    public function cancelsP()
    {
        return $this->hasMany(CancelP::class);
    }

    public function ratings()
    {
        return $this->hasManyThrough(Rating::class, Booking::class, 'personnel_id', 'booking_id');
    }
}
