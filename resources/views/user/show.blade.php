@extends('layouts.app')

@section('content')

<div id='app'>
    
    <profile :user="{{ $user }}" :auth="{{ json_encode(\Illuminate\Support\Facades\Auth::user()) }}"></profile>

	<usercards :user="{{ $user }}" :posts="{{ $posts }}"></usercards>

    @foreach ($comments as $comment)
        <comment :comment="{{ $comment }}"
                 :user="{{ json_encode($user) }}"></comment>
    @endforeach

      
</div>

@endsection
