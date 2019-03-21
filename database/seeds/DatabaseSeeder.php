<?php

use App\User;
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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);

        $tags = factory('App\Tag', 8)->create();
        $categories = factory('App\Category', 5)->create();

        factory('App\Post', 15)->create()->each(function($post) use ($tags){
            $post->comments()->save(factory('App\Comment')->make());
            $post->categories()->attach(mt_rand(1,5));
            $post->tags()->attach($tags->random(mt_rand(1,4))->pluck('id')->toArray());
        });
    }
}
