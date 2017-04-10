@extends('layouts.app')

@section('content')

<div id='app'>
    
    <profile :user="{{ $user }}" ></profile>

	<usercards :user="{{ $user }}" :posts="{{ $posts }}"></usercards>

    @foreach ($comments as $comment)
        <comment :comment="{{ $comment }}"></comment>
    @endforeach -->

      
</div>

@endsection
