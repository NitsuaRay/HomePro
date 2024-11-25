<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_details',
        'picture_details',
        'service_date',
        'payment_method',
        'personnel_id',
        'user_id',
        'booking_status',
        'fee',
        'extra_fee',
        'fee_details',
        'gcash_picture',
        'completed_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'booking_id');
    }

    public function cancels()
    {
        return $this->hasMany(Cancel::class);
    }

    public function cancelsP()
    {
        return $this->hasMany(CancelP::class);
    }
}
