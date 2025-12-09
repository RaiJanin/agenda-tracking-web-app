@extends('v2.layout.app')


@section('title', 'Agenda WEB | All Agendas')

@section('styles')
    
@endsection

@section('main-content')
    @include('v2.ui.agenda.all-agenda')
@endsection

@section('scripts')
    @if(!request()->route('agenda_id'))
        <script src="{{ asset('js/modules/agendaLoad.js') }}" type="module"></script>
    @else
        <script src="{{ asset('js/modules/selectedAgendaMo.js') }}" type="module"></script>
        <script src="{{ asset('js/modules/concernEAgen.js') }}" type="module"></script>
    @endif
    <script src="{{ asset('js/components/pagination.js') }}"></script>
@endsection