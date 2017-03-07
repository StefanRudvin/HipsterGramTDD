<?php

use Illuminate\Database\Seeder;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => str_random(10),
            'content' => str_random(100),
            'user_id' => App\User::all()->random()->id,
            ]);
    }
}
