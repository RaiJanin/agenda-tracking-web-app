@extends('v2.layout.content-layout')

    @section('content-head-text', request()->route('agenda_id') ? 'Concern' : 'All Concerns')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
        @if(request()->route('agenda_id'))
            @include('v2.ui.concerns.concern-sel')
        @else
            <div id="concern-container" class="grid grid-cols-1 lg:grid-cols-2 gap-5"></div>
        @endif
    @endsection