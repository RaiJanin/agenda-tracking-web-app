@extends('v2.layout.app')


@section('title', 'Agenda WEB | Memberships')

@section('styles')
    
@endsection

@section('main-content')
    @if(auth()->user()->role === 'admin')
        @include('v2.ui.people.membersRqst-ui')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')
    @if(auth()->user()->role === 'admin')
        <script src="{{ asset('js/modules/memberRequestsLoad.js') }}" type="module"></script>
    @endif
@endsection