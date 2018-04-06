@extends('layouts.app')

@section('content')

    <div id='app'>
        <newpost :user="{{ json_encode(\Illuminate\Support\Facades\Auth::user()) }}"></newpost>
    </div>

@endsection
