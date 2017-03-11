@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            @include('layouts.posts._post')

            @include('layouts/comments/_comments')

            @include('layouts/comments/_commentform')

        </div>
    </div>
</div>

@endsection
