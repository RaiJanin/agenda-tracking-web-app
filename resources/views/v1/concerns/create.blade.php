<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body class="bg-gray-50">
<div class="flex h-screen">
    @include('partials.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('layouts.header-admin')

        <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
            <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Add Concern / Issue</h2>

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
                                <input type="file" name="file" class="w-full border rounded-md p-2">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('concerns.index', $agenda->agenda_id) }}" 
                               class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-200">Cancel</a>

                            <button type="submit" 
                                    class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">
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
        </main>
    </div>
</div>
</body>
</html>
