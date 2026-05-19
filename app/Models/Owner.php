<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'name', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kosPlaces()
    {
        return $this->hasMany(KosPlace::class);
    }
}