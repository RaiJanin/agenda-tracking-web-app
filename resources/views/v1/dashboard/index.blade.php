<!DOCTYPE html>
<html lang="en">
@include('partials.head')


<body class="bg-gray-50">
    <!-- Fixed Layout -->
    <div class="flex h-screen">
        <!-- Sidebar - Full Height -->
        <!-- Full Height Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content Area with Header -->
        <div class="flex-1 flex flex-col overflow-hidden">
@include('layouts.header-admin')

            <!-- Main Content - Scrollable area -->
            <main class="flex-1 overflow-y-auto bg-gray-100">
<div class="p-8 bg-gray-100 min-h-screen">

    <h1 class="text-3xl font-bold text-gray-800 mb-6"> Dashboard Overview</h1>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">Total Agendas</h3>
            <p class="text-3xl font-bold text-amber-600">{{ $totalAgendas }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">Total Concerns</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalConcerns }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">Open Concerns</h3>
            <p class="text-3xl font-bold text-green-600">{{ $openConcerns }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">Closed Concerns</h3>
            <p class="text-3xl font-bold text-red-600">{{ $closedConcerns }}</p>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" class="flex flex-wrap items-center gap-4 mb-8 bg-white p-4 rounded-xl shadow">
        <div>
            <label for="agenda_id" class="block text-sm text-gray-600">Filter by Agenda:</label>
            <select name="agenda_id" id="agenda_id" class="border rounded-lg px-3 py-2">
                <option value="">All Agendas</option>
                @foreach($agendas as $agenda)
                    <option value="{{ $agenda->agenda_id }}">{{ $agenda->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="responsible_person_id" class="block text-sm text-gray-600">Filter by Responsible:</label>
            <select name="responsible_person_id" id="responsible_person_id" class="border rounded-lg px-3 py-2">
                <option value="">All Users</option>
                @foreach($responsiblePersons as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-amber-500 text-black px-4 py-2 rounded-lg hover:bg-amber-600 transition">
            Apply Filters
        </button>
    </form>

    {{-- Concerns by Status --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Concerns by Status</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @forelse($concernsByStatus as $status => $count)
                <div class="text-center border rounded-lg p-4">
                    <p class="font-semibold capitalize text-gray-700">{{ $status }}</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $count }}</p>
                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center">No concern data available.</p>
            @endforelse
        </div>
    </div>

</div>
            </main>
        </div>
    </div>


</body>

</html>
