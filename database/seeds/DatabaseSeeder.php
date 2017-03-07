<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #$this->call(UsersTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        factory(App\User::class, 20)->create()->each(function ($u) {
            $u->posts()->save(factory(App\Post::class)->make());
            $u->posts()->save(factory(App\Post::class)->make());
            $u->posts()->save(factory(App\Comment::class)->make());
            $u->posts()->save(factory(App\Comment::class)->make());
            $u->posts()->save(factory(App\Comment::class)->make());
        });
    }
}
