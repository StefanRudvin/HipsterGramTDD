@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3> Edit note </h3>
                </div>

            </div>


            <form method="POST" action="/posts/{{ $post->id }}">

                {{ method_field('PATCH') }}
                
                <div class="form-group">

                    <h3>Title</h3>

                    <textarea name="title" class="form-control">{{ $post->title }}</textarea>

                </div>

                <div class="form-group">

                    <h3>Content</h3>

                    <textarea name="content" class="form-control" rows="12">{{ $post->content }}</textarea>

                </div>
                <div class="form-group">

                    <button type="submit" class="btn btn-primary">
                    Update Post
                    </button>

                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>

            <form method="DELETE" action="/posts/{{ $post->id }}">

                {{ method_field('DELETE') }}

                <div class="form-group">

                    <button type="submit" class="btn btn-primary">
                    Delete Post
                    </button>

                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>
      
        </div>
    </div>
</div>

@endsection
