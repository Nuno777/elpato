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
                'name' => 'skeleton',
                'email' => 'skeleton@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'admin' => '5',
            ],
            [
                'name' => 'pekka',
                'email' => 'pekka@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'admin' => '5',
            ],
            [
                'name' => 'et',
                'email' => 'et13@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'admin' => '5',
            ],
            [
                'name' => 'calvo',
                'email' => 'calvo@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'admin' => '5',
            ]

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
