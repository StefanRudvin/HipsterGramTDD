<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'HipsterGram') }}</title>

<!-- Styles -->
<link href="/css/app.css" rel="stylesheet">

<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
</script>

<!-- Styles -->
<style>
    html, body {
        height: 100vh;
        margin: 0;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
        background: url('/header.jpg') center !important;
    }
</style>