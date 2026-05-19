<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['bank_name', 'bank_code', 'num_code'];

    public function userBankAccounts()
    {
        return $this->hasMany(UserBankAccount::class);
    }
}