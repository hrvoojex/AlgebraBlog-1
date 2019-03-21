@extends('layouts.master')

@section('content')

    <div class="col-sm-8 blog-main">

        @if(session()->has('flash_message'))
            <div class="alert alert-success alert-dismissible">
                {{ session()->get('flash_message') }}
            </div>
        @endif

        <div class="panel-heading">
            <a href="{{ route('posts.create') }}" class="btn btn-primary" style="margin-bottom: 20px" role="button">Dodaj novi post</a>                
        </div>
    
        @foreach ($posts as $key => $post)
            <div class="blog-post">
                <a href="{{ route('posts.show', $post->id) }}">
                    <h2 class="blog-post-title">{{ $post->title }}</h2>
                </a>
                <p class="blog-post-meta"> {{ $post->created_at->toFormattedDateString() }} by <a href="{{ route('user.posts.show', $post->user->id) }}">{{ $post->user->name }}</a></p>

                <section>{{ $post->body }}</section>
            </div>
        @endforeach      
    
        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>
    </div>
@endsection