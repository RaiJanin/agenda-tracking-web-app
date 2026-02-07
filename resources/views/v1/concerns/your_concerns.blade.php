
<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body class="bg-gray-50">
<div class="flex h-screen">
    @include('partials.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('layouts.header-admin')

                  <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="p-8 max-w-6xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">Your Concerns</h1>

                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Concern List --}}
                    @if($concerns->isEmpty())
                        <p class="text-gray-600">You have not submitted any concerns yet.</p>
                    @else
                        <div class="bg-white rounded-2xl shadow overflow-hidden">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-amber-500 text-black">
                                    <tr>
                                        <th class="px-6 py-3">Agenda Title</th>
                                        <th class="px-6 py-3">Concern Description</th>
                                        <th class="px-6 py-3">Responsible Person</th>
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

        {{-- Concern Description --}}
        <td class="px-6 py-3 truncate max-w-xs">
            {{ Str::limit($concern->description, 50) }}
        </td>

        {{-- Responsible Person --}}
        <td class="px-6 py-3">
            {{ $concern->responsible->name ?? 'Unassigned' }}
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
        <td class="px-6 py-3 text-center flex justify-center gap-3">
            <a href="{{ route('concerns.show', $concern->concern_id) }}"
               class="text-blue-600 hover:text-blue-800 font-medium">
                View
            </a>

            @if(auth()->id() === $concern->responsible_person_id)
                <a href="{{ route('concerns.edit', $concern->concern_id) }}"
                   class="text-yellow-600 hover:text-yellow-800 font-medium">
                    Edit
                </a>

                <form action="{{ route('concerns.destroy', $concern->concern_id) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this concern?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-red-600 hover:text-red-800 font-medium">
                        Delete
                    </button>
                </form>
            @endif
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
