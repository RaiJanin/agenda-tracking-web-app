@extends('v2.layout.app')


@section('title', 'Agenda WEB | Users Management')

@section('styles')
    
@endsection

@section('main-content')
    @if(auth()->user()->role === 'admin')
        @include('v2.ui.people-ui')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/usersLoad.js') }}"></script>
    <script src="{{ asset('js/components/pagination.js') }}"></script>
@endsection