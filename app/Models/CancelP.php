<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelP extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason',
        'personnel_id',
        'booking_id',
        'user_id',
    ];


    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the booking that owns the cancel.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
