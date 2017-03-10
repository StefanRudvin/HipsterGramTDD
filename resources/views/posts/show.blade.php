@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            @include('layouts._post')

            @include('layouts/_comments')

            @include('layouts/_commentform')

        </div>
    </div>
</div>

@endsection
