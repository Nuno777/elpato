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
                'uuid'=>'0a730be4-367e-489b-bc89-ec9c03757a23',
                'name' => 'nseven',
                'email' => 'nseven@elpato.xyz',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'admin',
                'telegram'=>'nseven',
                'blocked'=>'1',
                'slug'=>'dsjadsa-hdh-dash-dsajdsa',
            ],
            [
                'uuid'=>'1ea559c6-5f9f-45a1-bcc8-f46b072dc36a',
                'name' => 'Pekka',
                'email' => 'pekka@elpato.xyz',
                'email_verified_at' => '2023-01-03 13:19:13',
                'password' => Hash::make('admin12345'),
                'type' => 'admin',
                'telegram'=>'pekka',
                'blocked'=>'1',
                'slug'=>'dsjadsa-hdh-dash-dsa31dsa',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
