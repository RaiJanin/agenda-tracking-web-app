@extends('v2.layout.app')


@section('title', 'Agenda WEB | Calendar')

@section('styles')
    
@endsection

@section('main-content')
    @include('v2.ui.calendar.calendar-ui')
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/calendar.js') }}"></script>
@endsection