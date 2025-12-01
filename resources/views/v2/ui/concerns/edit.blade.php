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
                    @include('v2.components.error-all')
                @endif
                <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
                    <h4 class="text-xl font-bold mb-4">{{ $agenda['title'] }}</h4>

                    <form action="{{ route('concerns.update', $concern->concern_id) }}" method="POST">
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
                                        <option value="">-- Select Responsible Person --</option>
                                        @foreach($res_pers as $id => $responsible)
                                            <option value="{{ $id }}">{{ $responsible }}</option>
                                        @endforeach
                                    @else
                                        <option value=" ">{{ $res_pers[$concern->responsible_person_id] }} (Me)</option>
                                    @endif
                                </select>
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
                                <label class="block text-gray-700">Comments</label>
                                <textarea name="comments" class="w-full border rounded-md p-2" rows="2">{{ $concern->comments }}</textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="window.location.href=`{{ route('agenda.view', $concern->agenda_id) }}`" class="px-3 py-1.5 text-red-500 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-red-600 hover:shadow-md hover:border-red-500 focus:ring-2 focus:ring-red-400 focus:ring-offset-1 transition-all duration-300">
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