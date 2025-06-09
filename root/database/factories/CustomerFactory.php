<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['prospected', 'corresponding', 'completed'];

        // 電話番号の「-」削除して登録
        $phone = str_replace('-', '', fake()->phoneNumber());

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => $phone,
            'company_name' => fake()->company(),
            'status' => fake()->randomElement($statuses),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
