<?php

namespace Database\Seeders;

use App\Models\Specialtie;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'last_name' => 'Иванов',
            'first_name' => 'Иван',
            'middle_name' => 'Иванович',
            'phone' => '+79999999999',
            'email' => 'admin@email.com',
            'role' => 'admin',
            'login' => 'admin',
            'password' => 'admin',
        ]);

        Specialtie::create([
            'name' => 'Терапевт',
        ]);
    }
}
