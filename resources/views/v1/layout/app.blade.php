<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      @yield('title')
    </title>
    @include('includes.assets')
    @yield('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        @include('components.app-nav')

        <div class="overlay" id="overlay"></div>

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('components.header')
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                @yield('main-content')
            </main>
        </div>
        
    </div>
    @include('includes.script-assets')
    @yield('scripts')
</body>
</html>