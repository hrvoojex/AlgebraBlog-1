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
            $tags = Tag::has('posts')->pluck('name');
            $categories = Category::has('posts')->pluck('name');
            $view->with(compact('archives', 'tags', 'categories'));
        });
    }
}
