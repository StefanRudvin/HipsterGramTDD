@extends('layouts.app')

@section('content')

<div id='app'>
	<post :post="{{ $post }}"
		  :user="{{ json_encode(\Illuminate\Support\Facades\Auth::user()) }}">
	</post>

	<comments :post="{{ $post }}"
			  :user="{{ json_encode(\Illuminate\Support\Facades\Auth::user()) }}">
	</comments>

</div>

@endsection
