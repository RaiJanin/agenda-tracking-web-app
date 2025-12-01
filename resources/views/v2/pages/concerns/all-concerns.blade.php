@extends('v2.layout.app')


@section('title', 'Agenda WEB | All Concerns')

@section('styles')
    
@endsection

@section('main-content')
    @if(auth()->user()->role === 'admin')
        @include('v2.ui.concerns.all-concerns')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')
    @if(!request()->route('agenda_id'))
        <script src="{{ asset('js/modules/concernLoad.js') }}"></script>
    @endif
@endsection