<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'check_in_date',
        'check_out_date',
        'resource_id',
        'quest_name',
        'guest_email',
        'guest_phone',
        'guest_count',
        'booking_status_id',
        'total_price',
    ];

    public function resource() {
        return $this->belongsTo(Resource::class);
    }

    public function bookingStatus() {
    return $this->belongsTo(BookingStatus::class);
}

}
