<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Interaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $customers = Customer::all();

        foreach ($customers as $customer) {
            Interaction::factory(rand(1, 5))->create([
                'customer_id' => $customer->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}