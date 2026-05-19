<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;

#[Fillable(['username', 'full_name', 'profile_picture', 'bio', 'email', 'phone_number', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function owner()
    {
        return $this->hasOne(Owner::class);
    }

    public function wishlists()
    {
        return $this->belongsToMany(KosPlace::class, 'wishlists');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(UserBankAccount::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewReplies()
    {
        return $this->hasMany(ReviewReply::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}