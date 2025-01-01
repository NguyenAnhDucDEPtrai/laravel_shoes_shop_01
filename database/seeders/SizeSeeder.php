<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['size' => '39', 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['size' => '40.5', 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['size' => '41', 'status' => 'Block', 'created_at' => now(), 'updated_at' => now()],
            ['size' => '42', 'status' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['size' => '43', 'status' => 'Block', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('sizes')->insert($sizes);
    }
}
