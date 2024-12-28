<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();
        $categories = [];
        $brand_id = DB::table('brands')->pluck('id');

        for ($i = 0; $i < 30; $i++) {
            $categories[] = [
                'category_name' => $faker->words(3, true),
                'brand_id' => $faker->randomElement($brand_id),
                'status' => $faker->randomElement(['Active', 'Block']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('categories')->insert($categories);
    }
}
