@extends('v2.layout.app')


@section('title', 'Agenda WEB | Trashed Concerns')

@section('styles')
    
@endsection

@section('main-content')
    @if(in_array(auth()->user()->role, ['admin', 'member']))
        @include('v2.ui.trash.concerns-trash')
    @else
        @include('v2.components.warnings.unauthorized')
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/trashedConcerns.js') }}" type="module"></script>
@endsection