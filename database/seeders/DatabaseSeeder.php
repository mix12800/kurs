<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Schedule;
use App\Models\Spec;
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

        $users = [
            [
                'last_name' => 'Иванов',
                'first_name' => 'Иван',
                'middle_name' => 'Иванович',
                'phone' => '+79999999999',
                'email' => 'admin@email.com',
                'role' => 'admin',
                'login' => 'admin',
                'password' => 'admin',
            ],
            [
                'last_name' => 'Егоров',
                'first_name' => 'Егор',
                'middle_name' => 'Егорович',
                'phone' => '+79999999999',
                'email' => 'doctor@email.com',
                'spec_id' => '1',
                'role' => 'doctor',
                'login' => 'doctor',
                'password' => 'doctor',
            ]
        ];


        Spec::create([
            'name' => 'Терапевт',
        ]);

        foreach ($users as  $user) {
            User::create($user);
        }

        Office::create([
            'num' => '101',
            'doctor_id' => '2',
        ]);

        Schedule::create([
            "doctor_id"=>'2',
            "date"=>'01.01.2100',
            "start_time"=>'09:00',
            "end_time"=>'10:00',
        ]);
    }
}
