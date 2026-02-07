<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    @include('includes.assets')
    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-600">
    @yield('main-content')
    @yield('scripts')
</body>
</html>