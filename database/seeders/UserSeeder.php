<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 0; $i < 4; $i++) {
            $id = \DB::table('users')->insertGetId([
                'first_name' => $faker->name(),
                'last_name' => $faker->name(),
                'username' => $faker->name(),
                'email' => $faker->email(),
                'password' => $faker->password(),
                'user_role' => 2
            ]);
        }
    }
}
