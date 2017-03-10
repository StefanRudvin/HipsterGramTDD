@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3>
                        {{ $user->name }}
                    </h3>
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

            @include('layouts/_posts')

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3>
                        Comments
                    </h3>
                </div>

            </div>

            @include('layouts/_comments')
            
        </div>
    </div>
</div>
@endsection
