@extends('layouts.app')

@section('content')

<div id='app'>
	<h1>Users list</h1>
	<users :users="{{ $users }}"></users>
</div>

@endsection
