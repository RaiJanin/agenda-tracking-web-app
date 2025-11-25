@extends('v2.layout.app')


@section('title', 'Agenda WEB | My Concerns')

@section('styles')
    
@endsection

@section('main-content')
    @include('v2.ui.concerns.my-concerns')
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/myconcernLoad.js') }}"></script>
@endsection