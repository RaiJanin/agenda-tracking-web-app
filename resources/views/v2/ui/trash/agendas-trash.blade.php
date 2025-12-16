@extends('v2.layout.content-layout')

    @section('content-head-text', 'Trashed Agendas')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
    <div class="flex-1 overflow-y-auto bg-gray-50 min-h-screen">
        <div class="mx-auto p-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Date</th>
                            <th class="px-6 py-3 text-left">Created By</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                        @forelse($agendas as $agenda)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 font-medium">{{ $agenda->title }}</td>
                                <td class="px-6 py-3">{{ \Carbon\Carbon::parse($agenda->date)->format('M d, Y') }}</td>
                                <td class="px-6 py-3">{{ $agenda->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-3 text-center space-x-3">

                                    {{-- Only show Edit & Archive for Admins --}}
                                    @if(Auth::user()->role === 'admin')
                                        <form action="{{ route('agenda.forceDelete', $agenda->agenda_id) }}" 
                                            method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline"
                                                    onclick="return confirm('This agenda will be removed permanently. Proceed?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No agendas found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection