<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['kos_place_id', 'room_number', 'is_available', 'price_custom', 'description'];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
        ];
    }

    public function kosPlace()
    {
        return $this->belongsTo(KosPlace::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}