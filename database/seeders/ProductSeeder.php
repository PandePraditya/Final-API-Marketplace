<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('products')->insert([
            [
                'name' => 'Adidas Sneakers',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzU_fAPrVMe1QHEwlmFTCX2aFeL0Mb_cbbdA&s',
                'price' => 100,
                'stock' => 50,
                'category_id' => 1,
                'brand_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Sony Headphones',
                'image' => 'https://sony.scene7.com/is/image/sonyglobalsolutions/wh-ch520_Primary_image?$categorypdpnav$&fmt=png-alpha',
                'price' => 150,
                'stock' => 30,
                'category_id' => 2,
                'brand_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
