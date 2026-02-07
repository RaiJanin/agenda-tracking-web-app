<div class="col-span-3 lg:col-span-2 border-2 border-gray-300 shadow-md">
    <div class="grid grid-row-3">
        <div class="flex items-center justify-between px-4 py-3 bg-white shadow">
            <div class="flex flex-col md:flex-row gap-1">
                <div class="relative">
                    <button id="month-select" class="flex items-center gap-2 text-gray-700 rounded-lg hover:bg-gray-200 p-1 transition-all duration-200">
                        <h2 id="h2-month" class="text-lg md:text-2xl font-bold text-gray-700"></h2>
                        <i data-feather="chevron-down" class="mt-1"></i>
                    </button>
                    <div id="month-dropdown" class="absolute hidden bg-white border border-gray-300 shadow-lg rounded-lg mt-2 w-36 z-50 max-h-80 overflow-y-auto">
                        @php
                            $months = [
                                'January','February','March','April','May','June',
                                'July','August','September','October','November','December'
                            ];
                        @endphp
                        @foreach ($months as $m)
                            <button class="w-full text-left px-4 py-2 hover:bg-blue-100 text-gray-700" data-month="{{ $loop->index }}">
                                {{ $m }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="relative">
                    <button id="year-select" class="flex items-center gap-2 text-gray-700 rounded-lg hover:bg-gray-200 p-1 transition-all duration-200">
                        <h3 id="h3-year" class="text-lg md:text-2xl font-bold text-gray-600"></h3>
                        <i data-feather="chevron-down" class="mt-1"></i>
                    </button>
                    <div id="year-dropdown" class="absolute hidden bg-white border border-gray-300 shadow-lg rounded-lg mt-2 w-28 z-50 max-h-60 overflow-y-auto">
                        @for ($y = now()->year - 5; $y <= now()->year + 5; $y++)
                            <button class="w-full text-left px-4 py-2 hover:bg-blue-100 text-gray-700" data-year="{{ $y }}">
                                {{ $y }}
                            </button>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button id="today-btn" class="text-base font-semibold text-gray-500 rounded-lg hover:bg-gray-300 p-1">Today</button>
                <button id="prev-month" class="p-2 rounded-lg hover:bg-gray-200 transition"><i data-feather="chevron-left"></i></button>
                <button id="next-month" class="p-2 rounded-lg hover:bg-gray-200 transition"><i data-feather="chevron-right"></i></button>
            </div>
        </div>

        <div class="w-full border border-gray-300"></div>

        <div id="calendar" class="flex-1 bg-gray-50"></div>
    </div>
</div>