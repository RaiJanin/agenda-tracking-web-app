@extends('v2.layout.app')


@section('title', 'Agenda WEB | Reports')

@section('styles')
    
@endsection

@section('main-content')
    @if(auth()->user()->role === 'admin')
        @include('v2.ui.archives.reports')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')

@endsection