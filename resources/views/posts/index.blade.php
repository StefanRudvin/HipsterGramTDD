@extends('layouts.app')

@section('content')

<div id='app'>

	@foreach ($posts as $post)
	    <post :post="{{ $post }}"
		:user="{{ json_encode(\Illuminate\Support\Facades\Auth::user()) }}"></post>
	@endforeach

</div>

@endsection
