<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('brands')->insert([
            [
                'name' => 'Adidas',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Sony',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
