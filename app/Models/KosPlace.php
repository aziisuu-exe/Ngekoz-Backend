<?php

namespace App\Models;

use App\Models\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KosPlace extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'owner_id', 'district_id', 'name', 'address', 'type', 
        'price_start_from', 'description', 'rules', 
        'latitude', 'longitude', 'rating_avg', 'is_verified'
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id'); 
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'kos_place_facility');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'kos_place_rule');
    }

}