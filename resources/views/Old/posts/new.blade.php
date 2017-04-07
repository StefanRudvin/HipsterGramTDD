@extends('layouts.app')

@section('content')

@component('layouts/posts/_postform')

    @slot('title')
    @endslot

    @slot('header')
        Create Post
    @endslot

    @slot('content')
    @endslot
    
    @slot('method')
    @endslot

    @slot('action')
        "/Post/new"
    @endslot

    @slot('btnName')
        Submit Post
    @endslot
@endcomponent

@endsection
