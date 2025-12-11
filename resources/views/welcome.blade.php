<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @include('v2.includes.assets')
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex items-center justify-center h-screen overflow-hidden">
        <div class="flex flex-col w-xl p-4">
            <div class="flex items-center gap-5 font-mono tracking-widest text-2xl sm:text-3xl font-semibold">
                <span class="mr-5 text-gray-400">A G E N D A</span>
                <span class="text-blue-500 tracking-tight">W E B</span>
            </div>
            <div class="border-t border-gray-400 w-xl mt-5"></div>
            <div class="flex items-center justify-between p-5 mt-2">
                @if (Route::has('login'))
                    @auth
                        <!-- <a
                            href="{{ route('home') }}"
                            class="px-6 rounded-lg font-semibold text-lg tracking-wider hover:border hover:border-blue-500 hover:py-1 hover:bg-blue-200 hover:text-blue-600 transition-all duration-600"
                        >
                            Dashboard
                        </a> -->
                        <script>
                            window.location.href=`{{ route('home') }}`;
                        </script>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-6 rounded-lg font-semibold text-lg tracking-wider hover:border hover:border-blue-500 hover:py-1 hover:bg-blue-200 hover:text-blue-600 transition-all duration-600"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="px-6 rounded-lg font-semibold text-lg tracking-wider hover:border hover:border-blue-500 hover:py-1 hover:bg-blue-200 hover:text-blue-600 transition-all duration-600"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</body>
</html>