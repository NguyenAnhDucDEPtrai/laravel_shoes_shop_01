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
        $brands = [
            ['brand_name' => 'Giày Nike', 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['brand_name' => 'Giày Adidas', 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['brand_name' => 'Giày Lacoste', 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['brand_name' => 'Giày Puma', 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['brand_name' => 'Giày Thể Thao', 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('brands')->insert($brands);
    }
}
