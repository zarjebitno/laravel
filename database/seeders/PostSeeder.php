<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 1; $i <= 8; $i++) {
            $id = \DB::table('posts')->insertGetId([
                'title' => $faker->sentences(2, true),
                'content' => $faker->sentences(4, true),
                'image' => $faker->image('public/assets/images/posts', 640, 480),
                'cat_id' => rand(1, 5),
                'user_id' => rand(1, 10),
            ]);

            \DB::table('user_posts')->insert([
                'post_id' => $id,
                'user_id' => rand(1,4)
            ]);
        }
    }
}
