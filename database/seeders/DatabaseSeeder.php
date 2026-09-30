<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Schedule;
use App\Models\Spec;
use App\Models\Ticket;
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
            ],
            [
                'last_name' => 'Петренко',
                'first_name' => 'Пётр',
                'middle_name' => 'Петрович',
                'phone' => '+79999999999',
                'email' => 'user@email.com',
                'login' => 'user',
                'password' => 'user',
            ]
        ];


        Spec::create([
            'name' => 'Терапевт',
        ]);

        foreach ($users as $user) {
            User::create($user);
        }

        Office::create([
            'num' => '101',
        ]);

        Schedule::create([
            "doctor_id" => '2',
            "office_id"=>'1',
            "date" => '01.01.2100',
            "start_time" => '09:00',
            "end_time" => '10:00',
        ]);

        Ticket::create([
            "user_id" => "3",
            "schedule_id" => "1",
            "date" => "01.01.2000",
            "time" => "10:00",
        ]);
    }
}
