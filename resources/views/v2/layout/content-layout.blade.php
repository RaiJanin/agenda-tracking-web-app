<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">
        @yield('content-head-text')
    </h2>
    <div class="flex flex-col items-center gap-2">
        @yield('content-head-buttons')
    </div>
</div>

@yield('contents')