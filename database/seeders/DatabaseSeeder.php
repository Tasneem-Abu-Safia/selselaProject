<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            CatrgorySeeder::class,
//            ProductSeeder::class,
//            RolesAndPermissionsSeeder::class,
//            UsersTableSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
//        for ($i = 0; $i < 7; $i++) {
//            \App\Models\Colors::create([
//                'color' => 'color' . $i,
//            ]);
//            \App\Models\Sizes::create([
//                'size' => 'size' . $i,
//            ]);
//        }
    }
}
