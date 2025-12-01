@extends('v2.layout.app')


@section('title', 'Agenda WEB | All Agendas')

@section('styles')
    
@endsection

@section('main-content')
    @include('v2.ui.agenda.all-agenda')
@endsection

@section('scripts')
    @if(!request()->route('agenda_id'))
        <script src="{{ asset('js/modules/agendaLoad.js') }}"></script>
        <script src="{{ asset('js/rest-api/archiveAgenda.js') }}"></script>
    @endif
@endsection