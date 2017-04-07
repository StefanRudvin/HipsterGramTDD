@extends('layouts.app')

@section('content')

<div id='app'>
	<post :post="{{ $post }}"></post>

	@foreach ($comments as $comment)
	    <comment :comment="{{ $comment }}"></comment>
	@endforeach

</div>

@endsection
