<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body class="bg-gray-50">
<div class="flex h-screen">
    @include('partials.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('layouts.header-admin')

        <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
            <div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Concerns / Issues</h2>
                        <p class="text-gray-500">Agenda: <strong>{{ $agenda->title }}</strong></p>
                    </div>
                    <a href="{{ route('concerns.create', $agenda->agenda_id) }}"
                       class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-md">
                        + Add Concern
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif

                @if ($concerns->isEmpty())
                    <p class="text-gray-500">No concerns found for this agenda.</p>
                @else
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Description</th>
                            <th class="px-4 py-2 border">Responsible</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Due Date</th>
                            <th class="px-4 py-2 border">Comments</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($concerns as $concern)
                            <tr>
                                <td class="border px-4 py-2">{{ $concern->description }}</td>
                                <td class="border px-4 py-2">{{ $concern->responsible_person }}</td>
                                <td class="border px-4 py-2">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($concern->status === 'completed') bg-green-200 text-green-800
                                        @elseif($concern->status === 'pending') bg-yellow-200 text-yellow-800
                                        @else bg-gray-200 text-gray-800 @endif">
                                        {{ ucfirst($concern->status) }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">{{ $concern->due_date ? \Carbon\Carbon::parse($concern->due_date)->format('M d, Y') : '-' }}</td>
                                <td class="border px-4 py-2">{{ $concern->comments ?? '-' }}</td>
                   <td class="border px-4 py-2 text-center">
    @if(auth()->id() == $concern->responsible_person_id || auth()->user()->role === 'it')
        <a href="{{ route('concerns.edit', $concern->concern_id) }}" class="text-blue-600 hover:underline">Edit</a> |
        <form action="{{ route('concerns.destroy', $concern->concern_id) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline"
                    onclick="return confirm('Delete this concern?')">Delete</button>
        </form>
    @endif

    <a href="{{ route('concerns.show', $concern->concern_id) }}" class="text-amber-600 hover:underline">View</a>
</td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                <div class="mt-4">
                    <a href="{{ route('agendas.show', $agenda->agenda_id) }}" class="text-gray-600 hover:underline">⬅ Back to Agenda</a>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
