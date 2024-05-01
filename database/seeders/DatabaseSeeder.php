<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Skeleton',
                'email' => 'skeleton@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'admin',
            ],
            [
                'name' => 'Pekka',
                'email' => 'pekka@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'admin',
            ],
            [
                'name' => 'ET',
                'email' => 'et13@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'worker',
            ],
            [
                'name' => 'Calvo',
                'email' => 'calvo@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'general',
            ]

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
