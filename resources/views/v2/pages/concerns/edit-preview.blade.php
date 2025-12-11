@extends('v2.layout.app')


@section('title', 'Agenda WEB | Edit Concern')

@section('styles')
    
@endsection

@section('main-content')
    @if(in_array(auth()->user()->role, ['admin']) || auth()->user()->id == $concern->responsible_person_id)
        @include('v2.ui.concerns.edit')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')
    
@endsection