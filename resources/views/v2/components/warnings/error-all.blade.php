<div class="close-error-container bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mt-5 mb-4">
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>  
    <button class="close-error-btn text-red-600 mt-4 rounded-md border border-red-500 px-3 py-1">Close</button> 
</div>
<script>
    document.querySelector('.close-error-btn').addEventListener('click', () => {
        document.querySelector('.close-error-container').classList.add('hidden');
    });
</script>