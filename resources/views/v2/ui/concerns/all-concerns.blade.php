@extends('v2.layout.content-layout')

    @section('content-head-text', request()->route('agenda_id') ? 'Concern' : 'All Concerns')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
        @if(request()->route('agenda_id'))
            @include('v2.ui.concerns.concern-sel')
        @else
            <script>
                const admiNAccess = {{ auth()->user()->role === 'admin' ? 'true' : 'false'}};
            </script>
            <div id="concern-container" class="grid grid-cols-1 lg:grid-cols-2 gap-5"></div>
            <div class="mt-5 text-xxs sm:text-sm px-4">
                <nav id="pagination" aria-label="Pagination Navigation" class="inline-flex items-center space-x-2 text-sm font-semibold"></nav>
                <div id="pagination-meta" class="mt-2"></div>
            </div>
        @endif
    @endsection