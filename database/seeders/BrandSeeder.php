<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $brands = [];
        foreach (range(1, 20) as $index) {
            $brands[] = [
                'brand_name' => $faker->company,
                'status' => $faker->randomElement(['Active', 'Block']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('brands')->insert($brands);
    }
}
