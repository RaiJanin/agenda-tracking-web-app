@extends('layout.content-layout')

    @section('content-head-text', 'Calendar')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
        <div class="grid grid-cols-3 gap-4">
            @include('ui.calendar.months')
            <div class="border-2 border-gray-300 shadow-sm">
                <h2 class="text-xl font-bold text-gray-700 p-4">Today</h2>
            </div>
        </div>
    @endsection