<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include ('layouts.minimal.head')
</head>
<body>

    @include ('layouts.minimal.nav')

    @yield('content')

    @include ('layouts.minimal.scripts')
    
</body>
</html>
