@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3> Create Post </h3>
                </div>

            </div>

            @include('layouts/_postform')
      
        </div>
    </div>
</div>

@endsection
