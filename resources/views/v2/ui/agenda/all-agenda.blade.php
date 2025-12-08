@extends('v2.layout.content-layout')

    @section('content-head-text', request()->route('agenda_id') ? 'View Agenda' : 'All Agenda')

    @section('content-head-buttons')
        @if(auth()->user()->role === 'admin')
            <button onclick="window.location.href=`{{ route('agenda.create') }}`" class="flex items-center bg-blue-600 text-white px-2 py-2 rounded-lg hover:bg-opacity-90 transition">
                <i data-feather="plus" class="mr-2 text-xs"></i><span>New Agenda</span>
            </button>
        @endif
        @if(request()->route('agenda_id'))
            <button onclick="window.location.href=`{{ route('agenda.view-all') }}`" class="flex items-center gap-3 bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-400 transition">
               <i class="fa-solid fa-arrow-left"></i><span>Back to List</span>
            </button>
        @endif
    @endsection

    @section('contents')
        @if (request()->route('agenda_id'))
            @include('v2.ui.agenda.agenda-sel')
        @else
            <script>
                const adminAccess = {{ auth()->user()->role === 'admin' ? 'true' : 'false'}};
            </script>
            <div id="agenda-container" class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <!-- all agenda loaded here-->
            </div>
            <div class="mt-5 text-xxs sm:text-sm px-4">
                <nav id="pagination" aria-label="Pagination Navigation" class="inline-flex items-center space-x-2 text-sm font-semibold"></nav>
                <div id="pagination-meta" class="mt-2"></div>
            </div>
        @endif
    @endsection