<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mt-5 mb-4">
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>   
</div>