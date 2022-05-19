<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_can_create_user()
    {
        $name = $this->faker->name();
        $email = $this->faker->email;
        $password = $this->faker->text();

        $this
            ->post("/api/register", [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
        ]);

        $user = User::where('email', $email)->first();

        $this->assertTrue(Hash::check($password, $user->password));
    }
}
