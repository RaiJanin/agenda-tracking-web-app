@extends('v2.layout.app')


@section('title', 'Agenda WEB | All Concerns')

@section('styles')
    
@endsection

@section('main-content')
    @include('v2.ui.concerns.all-concerns')
@endsection

@section('scripts')
    @if(!request()->route('agenda_id'))
        <script src="{{ asset('js/modules/concernLoad.js') }}" type="module"></script>
        <script src="{{ asset('js/utilities/pagination.js') }}"></script>
    @endif
@endsection