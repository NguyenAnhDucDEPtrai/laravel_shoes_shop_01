<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = [];

        $users[] = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'phone_number' => null,
            'address' => null,
            'role' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        for ($i = 0; $i < 30; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123'),
                'phone_number' => $faker->optional()->phoneNumber,
                'address' => $faker->optional()->address,
                'role' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}
