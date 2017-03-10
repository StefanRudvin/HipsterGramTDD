<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include ('layouts.head')
</head>
<body>
    <div id="app">
        @include ('layouts.nav')

        @yield('content')
    </div>
    @include ('layouts.scripts')
</body>
</html>
