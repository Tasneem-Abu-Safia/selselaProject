<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 15; $i++) {
            $user = User::create([
                'name' => Str::random(5),
                'email' => Str::random(8) . '@gmail.com',
                'password' => Hash::make(Str::random(8)),
            ]);
        }
        $user->assignRole('user');

    }
}
