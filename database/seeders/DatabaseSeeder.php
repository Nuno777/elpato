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
                'telegram'=>'Skeleton'
            ],
            [
                'name' => 'Pekka',
                'email' => 'pekka@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'admin',
                'telegram'=>'pekka'
            ],
            [
                'name' => 'ET',
                'email' => 'et13@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'worker',
                'telegram'=>'et'
            ],
            [
                'name' => 'Calvo',
                'email' => 'calvo@elpato.com',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'general',
                'telegram'=>'calvo'
            ]

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
