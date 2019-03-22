@extends('layouts.master')

@section('content')

<div class="col-sm-8 blog-main">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" style="background-color: #3CBC8D; color: white; padding: 20px; margin-bottom: 30px; text-align: center;">Update "{{ $post->title }}" post:</h3>
        </div>

        <div class="panel-body">
            <form method="post" action="{{ route('posts.update', $post->id) }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? 'has-error' : '' }} " id="title" name="title" value="{{ $post->title }}" />
                </div>
                <div class="form-group">
                    <label for="body">Body:</label>
                    <textarea class="form-control {{ $errors->has('body') ? 'has-error' : '' }} " id="body" name="body" rows="10" cols="80">{{ $post->body }}</textarea>
                </div>

                @isset ($categories) 
                    <div class="radio {{ $errors->has('category') ? 'has-error' : ''}}">
                         <label for="radio">Categories:</label><br/>
                         <div class="radio">     
                         @foreach ($categories as $category)
                              <label class="custom-control-radio">
                                   <input type="radio" name="category" id="category" value="{{ $category->id }}" {{ $category->posts->contains($post->id) ? 'checked=checked' : ''}}>
                                   {{ $category->name }}
                              </label>
                         @endforeach
                         </div>
                    </div>
                @endisset

                <br>

                <label for="tags">Tags:</label>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addTag" style="float: right">
                Add New Tag
                </button>
                <br/>
                <div class="d-block my-3">
                        @foreach($tags as $tag)
                        <label class="custom-control overflow-checkbox">
                            <input type="checkbox" value="{{ $tag->id }}" name="tags[]" class="overflow-control-input" {{ $tag->posts->contains($post->id) ? 'checked=checked' : ''}}>
                            <span class="overflow-control-indicator"></span>
                            <span class="overflow-control-description">{{ $tag->name }}</span>
                        </label>
                        @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Confirm</button>
                <a href="{{ route('posts') }}" class="btn btn-danger" role="button">Back</a>

                @include('layouts.errors')

            </form>
        </div>
    </div>

    @include('tags.modal')

</div>

@endsection