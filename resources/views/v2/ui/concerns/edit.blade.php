@extends('v2.layout.content-layout')

    @section('content-head-text', request()->route('concern_id') ? 'Edit Concern' : 'Empty Concern ID')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 overflow-y-auto">
            <div class="p-3 col-span-2">
                @if(session('success'))
                    <div class="flex items-center justify-between bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mt-5 mb-4">
                        {{ session('success') }}<span class="underline hover:text-green-500"><i class="fa-solid fa-arrow-left text-xs ml-5"></i><a href="{{ route('agenda.view', $agenda['agenda_id']) }}">Back to list</a></span>
                    </div>
                @endif
                @if ($errors->any())
                    @include('v2.components.warnings.error-all')
                @endif
                <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
                    <h4 class="text-xl font-bold mb-4">{{ $agenda['title'] }}</h4>

                    <form action="{{ route('concerns.update', $concern->concern_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-gray-700">Description</label>
                                <textarea name="description" class="w-full border rounded-md p-2" rows="3" required>{{ $concern->description }}</textarea>
                            </div>

                            @php $editable = auth()->user()->role === 'admin'; @endphp

                            <div>
                                <label class="block text-gray-700">Responsible Person</label>
                                <select name="responsible_person_id" class="w-full border rounded-md p-2" required @if(!$editable) disabled @endif>
                                    @if($editable)
                                        @foreach($res_pers as $id => $responsible)
                                            <option value="{{ $id }}"{{ $concern->responsible_person_id == $id ? 'selected' : ''}}>{{ $responsible }}</option>
                                        @endforeach
                                    @else
                                        <option value="">{{ $res_pers[$concern->responsible_person_id] }} (Me)</option>
                                    @endif
                                </select>
                                @if(!$editable)
                                    <input type="hidden" name="responsible_person_id" value="{{ $concern->responsible_person_id }}"/>
                                @endif
                            </div>

                            <div>
                                <label class="block text-gray-700">Status</label>
                                <select name="status" class="w-full border rounded-md p-2" required>
                                    <option value="pending" {{ $concern->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ongoing" {{ $concern->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ $concern->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700">Due Date</label>
                                <input type="date" name="due_date" class="w-full border rounded-md p-2" value="{{ $concern->due_date }}" required>
                            </div>

                            <div class="col-span-2">
                                <label class="block text-gray-700 font-medium mb-2">Replace File (Optional)</label>
                                <input type="file" name="file_path" class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-400 file:text-slate-700 hover:file:bg-gray-300 transition-all duration-400">
                                    @if($concern->attachments()->exists())
                                    @php $attachment = $concern->attachments()->first(); @endphp
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

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="window.history.back()" class="px-3 py-1.5 text-red-500 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-red-600 hover:shadow-md hover:border-red-500 focus:ring-2 focus:ring-red-400 focus:ring-offset-1 transition-all duration-300">
                                Cancel
                            </button>
                            <button type="submit" class="px-3 py-1.5 text-teal-800 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-teal-600 hover:shadow-md hover:border-teal-500 focus:ring-2 focus:ring-teal-400 focus:ring-offset-1 transition-all duration-300">
                                Update Concern
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection