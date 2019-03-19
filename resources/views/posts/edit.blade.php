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
                              <label>
                                   <input type="radio" name="category" id="category" value="{{ $category->id }}">
                                   {{ $category->name }}
                              </label>
                         @endforeach
                         </div>
                    </div>
                @endisset

                <label for="tags">Tags:</label>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addTag" style="float: right">
                Add New Tag
                </button>
                <br/>
                <div class="d-block my-3">
                        @foreach($tags as $tag)
                        <label class="custom-control overflow-checkbox">
                            <input type="checkbox" value="{{ $tag->id }}" name="tags[]" class="overflow-control-input">
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

    <!-- Modal -->
    <div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('tags.store') }}" method="post" id="addTagForm">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="" />
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="$('#addTagForm').submit()">Add Tag</button>
        </div>
        </div>
    </div>
    </div>

</div>

@endsection