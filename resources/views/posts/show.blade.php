@extends('layouts.master')

@section('content')
<div class="col-sm-8 blog-main">

    @if(session()->has('flash_message'))
        <div class="alert alert-success alert-dismissible">
            {{ session()->get('flash_message') }}
        </div>
    @endif

    <div class="blog-post">
        <a href="{{ route('posts.show', $post->id) }}">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
        </a>
        <p class="blog-post-meta"> {{ $post->created_at->toFormattedDateString() }} by <a href="#">{{ $post->user->name }}</a></p>

        @if(count($post->tags))
        <section>
            <h6 style="display: inline">Tags:</h6>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags', $tag) }}">{{ $tag->name }}</a>
            @endforeach
        </section>
        @endif
        
        <section>
            {{ $post->body }}
        </section>
	
	@if ( $post->user_id == auth()->id() )
	<form style="margin-top:4%" action="{{ route('posts.destroy',$post->id) }}" method="POST">
		{{ method_field('DELETE') }}
		{{ csrf_field() }} 
		<div class="btn-group btn-group-lg">
			<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Edit</a>
			<button class="btn btn-danger">Delete</button>
		</div>
		<div class="btn-group float-right btn-group-lg">	
			<a class="btn btn-primary" href="{{ route('posts') }}">Go Back</a>
		</div>
	</form>	
	@else 
		<div class="btn-group btn-group-lg">	
			<a class="btn btn-primary" href="{{ route('posts') }}">Go Back</a>
		</div>
	@endif
	<hr/>

        <div class="card">
            <div class="card-block">
                <form action="/posts/{{ $post->id }}/comment" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <textarea name="body" placeholder="Your comment here" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>
                </form>                
            </div>
        </div>

        @if (count($post->comments))
            <hr />
            <div class="comments">
                <h3>Comments:</h3>
                <ul>
                    @foreach($post->comments as $comment)

                        <li class="list-group-item">
                            <b>{{ $comment->user->name }}</b>&nbsp;
                            <i>{{ $comment->created_at->diffForHumans() }}</i>:&nbsp;
                            {{ $comment->body }}
                        </li>
                        
                    @endforeach
                </ul>            
            </div>
        @else
            <hr />
            <p>This post still doesnt have any comments!</p>
        @endif

    </div>
</div>
@endsection