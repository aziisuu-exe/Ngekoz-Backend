<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['kos_place_id', 'user_id', 'rating', 'comment'];

    public function kosPlace()
    {
        return $this->belongsTo(KosPlace::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(ReviewReply::class);
    }
}