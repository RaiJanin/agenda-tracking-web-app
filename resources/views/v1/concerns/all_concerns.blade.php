a<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body class="bg-gray-50">
    <div class="flex h-screen">
        @include('partials.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.header-admin')


            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="p-8 max-w-7xl mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">All Concerns</h1>
                        <a href="{{ route('agendas.index') }}"
                            class="bg-amber-500 text-black px-4 py-2 rounded-lg hover:bg-amber-600 transition">
                            ← Back to Agendas
                        </a>
                    </div>

                    @if($concerns->isEmpty())
                        <p class="text-gray-600">No concerns have been submitted yet.</p>
                    @else
                        <div class="bg-white rounded-2xl shadow overflow-hidden">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-800 text-white">
                                  <tr>
        <th class="px-6 py-3">Agenda Title</th>
        <th class="px-6 py-3">Responsible Person</th>
        <th class="px-6 py-3">Description</th>
        <th class="px-6 py-3">Status</th>
        <th class="px-6 py-3">Due Date</th>
        <th class="px-6 py-3">Date Created</th>
        <th class="px-6 py-3 text-center">Actions</th>
    </tr>
                                </thead>
                                <tbody>
@foreach($concerns as $concern)
    <tr class="border-b hover:bg-gray-50">
        {{-- Agenda Title --}}
        <td class="px-6 py-3">
            {{ $concern->agenda->title ?? 'N/A' }}
        </td>

        {{-- Responsible Person --}}
        <td class="px-6 py-3">
            {{ $concern->responsible->name ?? 'Unassigned' }}
        </td>

        {{-- Concern Description --}}
        <td class="px-6 py-3 truncate max-w-sm">
            {{ Str::limit($concern->description, 80) }}
        </td>

        {{-- Status --}}
        <td class="px-6 py-3 capitalize">
            {{ $concern->status ?? 'Pending' }}
        </td>

        {{-- Due Date --}}
        <td class="px-6 py-3">
            {{ $concern->due_date ? \Carbon\Carbon::parse($concern->due_date)->format('F d, Y') : 'No Due Date' }}
        </td>

        {{-- Date Created --}}
        <td class="px-6 py-3">
            {{ $concern->created_at ? $concern->created_at->format('F d, Y') : 'N/A' }}
        </td>

        {{-- Actions --}}
        <td class="px-6 py-3 text-center">
            <a href="{{ route('concerns.show', $concern->concern_id) }}"
               class="text-blue-600 hover:text-blue-800 font-medium">
               View
            </a>
        </td>
    </tr>
@endforeach

                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>

</html>
