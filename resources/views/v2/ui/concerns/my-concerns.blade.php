@extends('v2.layout.content-layout')

    @section('content-head-text', 'My Concerns')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
        <div id="myconcern-container" class="grid grid-cols-1 lg:grid-cols-2 gap-5"></div>
        <div class="mt-5 text-xxs sm:text-sm px-4">
            <nav id="pagination" aria-label="Pagination Navigation" class="inline-flex items-center space-x-2 text-sm font-semibold"></nav>
            <div id="pagination-meta" class="mt-2"></div>
        </div>
    @endsection