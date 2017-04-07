@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3>
                        {{ $user->name }}' Profile
                    </h3>

                    <div class="pull-left">
                        <a href="/user/{{$user->id}}/follow">{{ $user->followsCount() }}</a>
                    </div>

                    <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">
                    <form enctype="multipart/form-data" action="/user/{{$user->id}}" method="POST">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="pull-right btn btn-primary btn-sm">
                    </form>
                </div>

                <div class="panel-body">
                    {{ $user->bio }}
                </div>

            </div>

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3>
                        Posts
                    </h3>
                </div>

            </div>

            @include('layouts/posts/_posts')

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3>
                        Comments
                    </h3>
                </div>

            </div>

            @include('layouts/comments/_comments')
            
        </div>
    </div>
</div>
@endsection
