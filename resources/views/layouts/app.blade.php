<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include ('layouts.head')
</head>
<body>

    @include ('layouts.nav')

    @yield('content')

    @include ('layouts.scripts')
    
</body>
</html>
