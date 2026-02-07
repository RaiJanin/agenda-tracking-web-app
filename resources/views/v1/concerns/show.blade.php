
<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body class="bg-gray-50">
<div class="flex h-screen">
    @include('partials.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('layouts.header-admin')

        <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
<div class="max-w-3xl mx-auto bg-white shadow p-6 rounded-lg">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Concern Details</h1>

    <p><strong>Description:</strong> {{ $concern->description }}</p>
    <p><strong>Responsible:</strong> {{ $concern->responsible_person }}</p>
    <p><strong>Status:</strong> {{ ucfirst($concern->status) }}</p>
    <p><strong>Due Date:</strong> {{ $concern->due_date ? \Carbon\Carbon::parse($concern->due_date)->format('M d, Y') : 'N/A' }}</p>

    <a href="{{ url()->previous() }}" class="mt-4 inline-block text-blue-600 hover:underline">← Back</a>
</div>
        </main>
    </div>
</div>
</body>
</html>
