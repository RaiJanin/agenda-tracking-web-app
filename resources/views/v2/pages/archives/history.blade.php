@extends('v2.layout.app')


@section('title', 'Agenda WEB | History')

@section('styles')
    
@endsection

@section('main-content')
    @if(auth()->user()->role === 'admin')
        @include('v2.ui.archives.history')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')

@endsection