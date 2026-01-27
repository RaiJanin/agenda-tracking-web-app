@extends('v2.layout.app')


@section('title', 'Agenda WEB | Profile Settings')

@section('styles')
    
@endsection

@section('main-content')
    @include('v2.ui.settings.profile')
@endsection

@section('scripts')
    @if(auth()->user()->role === 'user')
        <script src="{{ asset('js/modules/guestProfile.js') }}" type="module"></script>
    @endif
@endsection