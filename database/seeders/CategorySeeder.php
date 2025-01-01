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
        $categories = [
            ['category_name' => 'Giày Chạy Bộ Nike', 'brand_id' => 1, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Nike Air', 'brand_id' => 1, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Nike Air Max', 'brand_id' => 1, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Nike Trắng', 'brand_id' => 1, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Nike Zoom', 'brand_id' => 1, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Thể Thao Nike', 'brand_id' => 1, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],

            ['category_name' => 'Giày Adidas Trắng', 'brand_id' => 2, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Chạy Bộ Adidas', 'brand_id' => 2, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Thể Thao Adidas', 'brand_id' => 2, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],

            ['category_name' => 'Giày Lacoste Nam', 'brand_id' => 3, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],

            ['category_name' => 'Giày Puma Nam', 'brand_id' => 4, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Puma Nữ', 'brand_id' => 4, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Thể Thao Puma', 'brand_id' => 4, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],

            ['category_name' => 'Giày Thể Thao Nam', 'brand_id' => 5, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Giày Thể Thao Nữ', 'brand_id' => 5, 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('categories')->insert($categories);
    }
}
