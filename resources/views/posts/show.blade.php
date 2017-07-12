@extends('layouts.app')

@section('content')

<div id='app'>
	<post :post="{{ $post }}"></post>

	<comments :post="{{ $post }}"></comments>

</div>

@endsection
