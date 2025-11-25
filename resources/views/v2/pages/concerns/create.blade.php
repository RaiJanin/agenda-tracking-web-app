@extends('v2.layout.app')


@section('title', 'Agenda WEB | Raise Concern')

@section('styles')
    
@endsection

@section('main-content')
    @include('v2.ui.concerns.create-concern')
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/concernLoad.js') }}"></script>
@endsection