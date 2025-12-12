<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      @yield('title')
    </title>
    @include('v2.includes.assets')
    @yield('styles')
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
    
        @include('v2.components.app-nav')

        <div class="overlay" id="overlay"></div>

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('v2.components.header')
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                @yield('main-content')
            </main>
            @if(Route::is('concerns.comments'))
                @include('v2.ui.comments.partials.comment-write', ['concern_id' => $concern->concern_id])
            @endif
        </div>
        
    </div>
    @include('v2.includes.script-assets')
    @yield('scripts')
</body>
</html>