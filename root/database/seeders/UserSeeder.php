<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 管理者
        User::create([
            'name' => '管理者ユーザー',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // スタッフ
        User::create([
            'name' => 'スタッフユーザー',
            'email' => 'staff@example.com',
            'password' => Hash::make('staff'),
            'role' => 'staff',
        ]);

        // ダミースタッフ
        User::factory(5)->create(['role' => 'staff']);
    }
}
