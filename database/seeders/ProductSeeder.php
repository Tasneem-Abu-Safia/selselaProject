<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 7; $i ++) {
            Product::create([
                'name' => ['en' => Str::random(5), 'ar' => Str::random(5)],
                'description' => ['en' => Str::random(10), 'ar' => Str::random(10)],
                'image' => Str::random(5),
                'price' => random_int(50, 100),
                'quantity' => random_int(20, 150),
                'category_id' => Category::inRandomOrder()->first()->id,
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
