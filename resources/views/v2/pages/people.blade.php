@extends('v2.layout.app')


@section('title', 'Agenda WEB | Users Management')

@section('styles')
    
@endsection

@section('main-content')
    @include('v2.ui.people-ui')
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/usersLoad.js') }}"></script>
@endsection