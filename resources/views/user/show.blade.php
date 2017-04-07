@extends('layouts.app')

@section('content')

<div id='app'>
	<div class="container-fluid">
    	<div class="flex-row row">

			<h1>{{ $user->name }}' Profile</h1>

			<div class="pull-left">
    			<a href="/user/{{$user->id}}/follow">
    		{{ $user->followsCount() }}</a>
    		</div>

    		<usercards :user="{{ $user }}" :posts="{{ $posts }}"></usercards>
            
    	</div>
    </div>

	
</div>

@endsection
