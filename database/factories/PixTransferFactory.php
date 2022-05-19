<?php

namespace Database\Factories;

use App\Models\PixTransfer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class PixTransferFactory extends Factory
{
    protected $model = PixTransfer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'amount' => $this->faker->numberBetween(10,1000),
            'key' => $this->faker->uuid(),
            'description' => $this->faker->text(30),
        ];
    }
}
