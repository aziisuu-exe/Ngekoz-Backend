<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $guarded = ['id'];

    public function kosPlaces()
    {
        return $this->belongsToMany(KosPlace::class, 'kos_place_rule');
    }
}