<div class="bg-white shadow rounded-lg p-4 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Concerns / Issues</h2>

        {{-- ✅ Only Admin or Member can add new concerns --}}
        @if(in_array(auth()->user()->role, ['admin', 'member']))
            <a href="{{ route('concerns.create', $agenda->agenda_id) }}"
               class="bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600">
                + Add Concern
            </a>
        @endif
    </div>

    @if($concerns->isEmpty())
        <p class="text-gray-500">No concerns yet for this agenda.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Responsible</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Due Date</th>
                    <th class="px-4 py-2 border text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($concerns as $concern)
                    <tr>
                        <td class="border px-4 py-2">{{ $concern->description }}</td>
                        <td class="border px-4 py-2">{{ $concern->responsible_person }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($concern->status) }}</td>
                        <td class="border px-4 py-2">
                            {{ $concern->due_date ? \Carbon\Carbon::parse($concern->due_date)->format('M d, Y') : '-' }}
                        </td>

                        <td class="border px-4 py-2 text-center">
                            {{-- 👁️ View button — visible to everyone --}}
                            <a href="{{ route('concerns.show', $concern->concern_id) }}"
                               class="text-blue-600 hover:underline">View</a>

                            {{-- ✏️ Edit: allowed if user owns the concern --}}
                            @if(in_array(auth()->user()->role, ['admin', 'member']) &&
                                $concern->responsible_person === auth()->user()->name)
                                | <a href="{{ route('concerns.edit', $concern->concern_id) }}"
                                     class="text-amber-600 hover:underline">Edit</a>
                            @endif

                            {{-- 🗑️ Delete: only Admin AND only if owns it --}}
                            @if(auth()->user()->role === 'admin' &&
                                $concern->responsible_person === auth()->user()->name)
                                | <form action="{{ route('concerns.destroy', $concern->concern_id) }}"
                                        method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:underline"
                                            onclick="return confirm('Delete this concern?')">
                                        Delete
                                    </button>
                                </form>
                            @endif

                            {{-- 🚫 Auditors can’t perform any actions other than view --}}
                            @if(auth()->user()->role === 'user')
                                {{-- No edit/delete/add shown --}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
