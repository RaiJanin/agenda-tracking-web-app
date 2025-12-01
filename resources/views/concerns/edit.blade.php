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
                <h2 class="text-2xl font-bold mb-4">Edit Concern / Issue</h2>

                <form action="{{ route('concerns.update', $concern->concern_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-gray-700">Description</label>
                            <textarea name="description" class="w-full border rounded-md p-2" rows="3" required>{{ $concern->description }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700">Responsible Person</label>
                            <select name="res_person" class="w-full border rounded-md p-2" required>
                                @foreach($res_pers as $id => $responsible)
                                    <option value="{{ $id }}">{{ $responsible }}</option>
                                @endforeach
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
                        <a href="{{ route('concerns.index', $concern->agenda_id) }}" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-200">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">Update Concern</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
</body>
</html>
