@extends('layouts.app')

@section('content')

<div id='app'>

	@foreach ($followedPosts as $post)
	    <post :post="{{ $post }}"></post>
	@endforeach

</div>

@endsection
