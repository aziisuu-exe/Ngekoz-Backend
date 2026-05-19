<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['kos_place_id', 'photo_type_id', 'image_url', 'caption', 'is_primary'];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    public function kosPlace()
    {
        return $this->belongsTo(KosPlace::class);
    }

    public function photoType()
    {
        return $this->belongsTo(PhotoType::class);
    }
}