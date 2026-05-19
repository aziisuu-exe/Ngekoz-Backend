<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoType extends Model
{
    use HasFactory;
    protected $fillable = ['type_name'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}