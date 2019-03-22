<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;
use App\Tag;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function($view){
            $archives = Post::archives();
<<<<<<< HEAD
            $tags = Tag::pluck('name');
            $categories = Category::pluck('name');
=======
            $tags = Tag::has('posts')->pluck('name');
            $categories = Category::has('posts')->pluck('name');
>>>>>>> ba43fe5548a21b38da351833269257e0a7638dfa
            $view->with(compact('archives', 'tags', 'categories'));
        });
    }
}
