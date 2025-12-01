@extends('v2.layout.content-layout')

    @section('content-head-text', 'Agenda Edit Mode')

    @section('content-head-buttons')
        <button onclick="window.history.back()" class="flex items-center justify-between gap-3 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition">
            <i class="fa-solid fa-arrow-left"></i><p>Back</p>
        </button>
    @endsection

    @section('contents')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 overflow-y-auto">
            <div class="p-3 col-span-2">
                @php
                    $user = auth()->user();
                    $isAdmin = $user->role === 'admin';
                    $isCreator = $agenda->created_by === $user->id;
                    $isUser = !$isAdmin && !$isCreator;
                @endphp

                @if(session('success'))
                    <div class="flex items-center justify-between bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mt-5 mb-4">
                        <p>{{ session('success') }}</p><span class="underline hover:text-green-500"><i class="fa-solid fa-arrow-left text-xs ml-5"></i><a href="{{ route('agenda.view-all') }}">Back to list</a></span>
                    </div>
                @endif
                @if ($errors->any())
                    @include('v2.components.warnings.error-all')
                @endif

                <form action="{{ route('agendas.update', $agenda->agenda_id) }}" method="POST" enctype="multipart/form-data"
                    class="bg-white shadow rounded-2xl p-6">
                    @csrf
                    @method('PUT')

                    @if($isUser)
                        <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 text-sm rounded-lg">
                            ⚠️ You have view-only access to this agenda.
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-6">
                        {{-- Title --}}
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Title</label>
                            <input type="text" name="title" value="{{ old('title', $agenda->title) }}"
                                class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-amber-500 focus:border-amber-500 
                                {{ !$isCreator ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                {{ !$isCreator ? 'disabled' : 'required' }}>
                        </div>

                        {{-- Date --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Date</label>
                            <input type="text" value="{{ \Carbon\Carbon::parse($agenda->date)->format('F d, Y') }}"
                                class="w-full border border-gray-200 rounded-lg p-2.5 bg-gray-100 text-gray-600 cursor-not-allowed"
                                readonly>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Status</label>
                            @if($isAdmin)
                                <select name="status"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-amber-500 focus:border-amber-500">
                                    <option value="pending" {{ $agenda->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ongoing" {{ $agenda->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="resolved" {{ $agenda->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ $agenda->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            @else
                                <input type="text" value="{{ ucfirst($agenda->status) }}"
                                    class="w-full border border-gray-200 rounded-lg p-2.5 bg-gray-100 text-gray-600 cursor-not-allowed"
                                    readonly>
                            @endif
                        </div>

                        {{-- Notes --}}
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Notes</label>
                            <textarea name="notes" rows="4"
                                class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-amber-500 focus:border-amber-500
                                {{ !$isCreator ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                {{ !$isCreator ? 'disabled' : '' }}>{{ old('notes', $agenda->notes) }}</textarea>
                        </div>

                        {{-- File --}}
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Replace File (Optional)</label>
                            <input type="file" name="file_path"
                                class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer 
                                focus:outline-none 
                                file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-400 file:text-slate-700
                                hover:file:bg-gray-300 transition-all duration-400"
                                {{ !$isCreator ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                {{ !$isCreator ? 'disabled' : '' }}>
                                @if($agenda->attachments()->exists())
                                @php $attachment = $agenda->attachments()->first(); @endphp
                                <p class="text-sm text-gray-600 mt-2">
                                    Current file:
                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 underline">
                                        {{ basename($attachment->file_path) }}
                                    </a>
                                </p>
                            @endif
                            
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end gap-4 mt-6">
                        <button type="button" onclick="window.location.href=`{{ route('agenda.view', $agenda->agenda_id) }}`"
                            class="px-3 py-1.5 text-red-500 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-red-400 hover:shadow-md hover:border-red-500 focus:ring-2 focus:ring-red-400 focus:ring-offset-1 transition-all duration-300">
                            Cancel
                        </button>

                        @if($isCreator || $isAdmin)
                            <button type="submit"
                                class="px-3 py-1.5 text-teal-800 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-teal-600 hover:shadow-md hover:border-teal-500 focus:ring-2 focus:ring-teal-400 focus:ring-offset-1 transition-all duration-300">
                                Save Agenda
                            </button>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    @endsection