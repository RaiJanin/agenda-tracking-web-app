@extends('v2.layout.app')


@section('title', 'Agenda WEB | '.$concern->description.' | Comments')

@section('styles')
    
@endsection

@section('main-content')
    @if(in_array(auth()->user()->role, ['admin', 'member']))
        @include('v2.ui.comments.comment-ui')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/commentWrite.js') }}" type="module"></script>
    <script src="{{ asset('js/modules/commentLoad.js') }}" type="module"></script>
@endsection