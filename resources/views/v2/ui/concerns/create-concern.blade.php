@extends('v2.layout.content-layout')

    @section('content-head-text', 'Raise Concerns')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 overflow-y-auto">
            <div class="p-3 col-span-2">
                @if(session('success'))
                    <div class="flex items-center justify-between bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mt-5 mb-4">
                        {{ session('success') }}<span class="underline hover:text-green-500"><i class="fa-solid fa-arrow-left text-xs ml-5"></i><a href="{{ route('agenda.view', $agenda->agenda_id) }}">Back to list</a></span>
                    </div>
                @endif
                @if ($errors->any())
                    @include('v2.components.error-all')
                @endif
                <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Add Concern/Issue for {{ $agenda->title }}</h2>

                    {{-- Restrict form access: only admin and member can create --}}
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'member')
                        <form action="{{ route('concerns.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="agenda_id" value="{{ $agenda->agenda_id }}">

                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-gray-700">Description</label>
                                    <textarea name="description" class="w-full border rounded-md p-2" rows="3" required></textarea>
                                </div>

                                {{-- Responsible person (auto-filled and locked) --}}
                                <div>
                                    <label class="block text-gray-700">Responsible Person</label>
                                    <input type="text" name="responsible_person" value="{{ Auth::user()->name }}" 
                                            class="w-full border rounded-md p-2 bg-gray-100 text-gray-700" readonly>
                                </div>

                                {{-- Status control --}}
                                <div>
                                    <label class="block text-gray-700">Status</label>
                                    <select name="status" class="w-full border rounded-md p-2" required>
                                        <option value="pending">Pending</option>

                                        {{-- Only admin can mark as completed --}}
                                        @if(auth()->user()->role === 'admin')
                                            <option value="completed">Completed</option>
                                        @endif
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-gray-700">Due Date</label>
                                    <input type="date" name="due_date" class="w-full border rounded-md p-2">
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-gray-700">Comments</label>
                                    <textarea name="comments" class="w-full border rounded-md p-2" rows="2"
                                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'member') 
                                                    placeholder="Add any comments or details here..." 
                                                @else 
                                                    readonly 
                                                @endif></textarea>
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-gray-700">File Attachment</label>
                                    <input type="file" name="file"
                                            class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer 
                                            focus:outline-none 
                                            file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-400 file:text-slate-700
                                            hover:file:bg-gray-300 transition-all duration-400">
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end space-x-3">
                                <button type="button" onclick="window.location.href=`{{ route('agenda.view', $agenda->agenda_id) }}`" class="px-3 py-1.5 text-red-500 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-red-600 hover:shadow-md hover:border-red-500 focus:ring-2 focus:ring-red-400 focus:ring-offset-1 transition-all duration-300">
                                    Cancel
                                </button>
                                <button type="submit" class="px-3 py-1.5 text-teal-800 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-teal-600 hover:shadow-md hover:border-teal-500 focus:ring-2 focus:ring-teal-400 focus:ring-offset-1 transition-all duration-300">
                                    Save Concern
                                </button>
                            </div>
                        </form>
                    @else
                        {{-- View-only for user/auditor --}}
                        <div class="text-gray-600">
                            <p>You have <strong>view-only</strong> access to this section. Only administrators and members can add or modify concerns.</p>
                            <a href="{{ route('concerns.index', $agenda->agenda_id) }}" 
                                class="mt-4 inline-block text-blue-600 hover:underline">← Back to Concerns</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection