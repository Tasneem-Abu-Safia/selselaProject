<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CatrgorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 7; $i ++){

           Category::create([
            'name' => ['en' => Str::random(5) , 'ar' => Str::random(5) ],
            'icon' => Str::random(5),
            'parent_id' =>null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        }
    }
}
