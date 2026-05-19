<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KosPlaceModelTest extends TestCase
{
    use RefreshDatabase; 

    public function test_owner_belongs_to_user(): void
    {
        $user = User::create([
            'username' => 'testuser',
            'email' => 'test@mail.com',
            'password' => 'password'
        ]);
        
        $owner = Owner::create([
            'user_id' => $user->id,
            'name' => 'Bapak Kos',
            'phone_number' => '0812345678'
        ]);

        $this->assertEquals('testuser', $owner->user->username);
    }
}