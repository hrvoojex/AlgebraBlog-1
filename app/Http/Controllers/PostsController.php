<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use App\Tag;
use App\Category;

class PostsController extends Controller
{

    public function __construct(){

        $this->middleware('auth')->except(['index', 'show']);
      //  $this->middleware('verified');
    }

    public function index(){
        // $posts = DB::table('posts')->get();
        $posts = Post::latest();

        // SELECT year(created_at) as year, monthname(created_at) as month, count(*) as published_posts FROM posts GROUP BY year, month ORDER BY min(created_at) desc

       // if(isset($_GET['month'])){ }

        if($month = request('month')){
            $posts->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if($year = request('year')){
            $posts->whereYear('created_at', $year);
        }
        
        $posts = $posts->get();

        //$archives = Post::archives();

        return view('posts.index', compact('posts'));
    }

    public function show($id){
        // $post = DB::table('posts')->find($id);
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    public function create(){

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->with(compact('categories', 'tags'));
    }

    public function store(){

        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'body' => 'required|min:3|max:65535'
        ]);

        $post = Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        $tags = request('tags');        
        $post->tags()->attach($tags);

        $post->categories()->attach(request('category'));
        

        return redirect()->route('posts')->withFlashMessage('Post added successfully.');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('post','categories', 'tags'));
    }

    public function update($id)
    {
        request()->validate([
            'title' =>  'required|min:3|max:255',
            'body'  =>  'required|min:3|max:65535'
        ]);
        
        $post = Post::find($id);
        $post_title = $post->title;
        $post->title = request('title');
        $post->body = request('body');        
        $post->save();

        $post->tags()->sync(request('tags'));
        $post->categories()->sync(request('category'));

        return redirect()->route('posts.show', $post->id)->withFlashMessage('Post "'.$post_title.'" updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post_title = $post->title;
        $post->delete();

        return redirect()->route('posts')->withFlashMessage('Post "'.$post_title.'" deleted successfully.');
    }

    public function showPostsForUser($id){

        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return view('posts.index', compact('posts'));
    }
}
