<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interaction>
 */
class InteractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['prospected', 'corresponding', 'completed'];
        $supported_types = ['opposing', 'phone', 'email', 'other'];

        return [
            'customer_id' => Customer::factory(),
            'user_id' => User::factory(),
            'content' => fake()->realText(120),
            'status' => fake()->randomElement($statuses),
            'supported_types' => fake()->randomElement($supported_types),
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
