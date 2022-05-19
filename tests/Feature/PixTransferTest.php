<?php

namespace Tests\Feature;

use App\Models\PixTransfer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PixTransferTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_should_return_a_list_of_pix_transfers_of_the_user()
    {
        $user = User::factory()->create();

        PixTransfer::factory()
            ->count(7)
            ->create([
                'user_id' => $user->id,
            ]);

        PixTransfer::factory()
            ->count(30)
            ->create();

        $this
            ->actingAs($user)
            ->getJson('/api/pix-transfers')
            ->assertSuccessful()
            ->assertJsonCount(7);
    }

    public function test_it_should_show_a_pix_transfer()
    {
        $user = User::factory()->create();

        $pixTransfer = PixTransfer::factory()
            ->create([
                'user_id' => $user->id,
            ]);

        $this
            ->actingAs($user)
            ->getJson("/api/pix-transfers/{$pixTransfer->id}")
            ->assertSuccessful()
            ->assertJson([
                'id' => $pixTransfer->id,
                'user_id' => $user->id,
                'amount' => $pixTransfer->amount,
                'key' => $pixTransfer->key,
                'description' => $pixTransfer->description,
            ]);
    }

    public function test_it_should_returns_a_not_found_error_when_get_a_pix_transfer_of_another_user()
    {
        $user = User::factory()->create();

        $pixTransfer = PixTransfer::factory()->create();

        $this
            ->actingAs($user)
            ->getJson("/api/pix-transfers/{$pixTransfer->id}")
            ->assertNotFound();
    }

    public function test_it_should_create_a_pix_transfer()
    {
        $user = User::factory()->create();

        $key = $this->faker->uuid();
        $amount = $this->faker->randomFloat(2, 1, 100);
        $description = $this->faker->text(15);

        $this
            ->actingAs($user)
            ->postJson("/api/pix-transfers", [
                'key' => $key,
                'amount' => $amount,
                'description' => $description,
            ])
            ->assertSuccessful()
            ->assertJson([
                'key' => $key,
                'amount' => $amount,
                'description' => $description,
            ]);

        $this->assertDatabaseHas(PixTransfer::class, [
            'key' => $key,
            'amount' => $amount,
            'user_id' => $user->id,
        ]);
    }
}
