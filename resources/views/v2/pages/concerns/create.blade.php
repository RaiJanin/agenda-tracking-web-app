@extends('v2.layout.app')


@section('title', 'Agenda WEB | Raise Concern')

@section('styles')
    
@endsection

@section('main-content')
    @if(in_array(auth()->user()->role, ['admin', 'member']))
        @include('v2.ui.concerns.create-concern')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')
    
@endsection