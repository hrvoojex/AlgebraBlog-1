<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
        $posts = $tag->posts;

        return view('posts.index', compact('posts'));
    }

    public function store(){

        $tag = request()->validate([
            'name' => 'required|min:3|max:255'
        ]);

        Tag::create($tag);

        return redirect()->back()->withFlashMessage('Tag added successfully.');
    }

}
