@extends('v2.layout.app')


@section('title', 'Agenda WEB | My Concerns')

@section('styles')
    
@endsection

@section('main-content')
    @if(in_array(auth()->user()->role, ['admin', 'member']))
        @include('v2.ui.concerns.my-concerns')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/myconcernLoad.js') }}" type="module"></script>
    <script src="{{ asset('js/utilities/pagination.js') }}"></script>
@endsection