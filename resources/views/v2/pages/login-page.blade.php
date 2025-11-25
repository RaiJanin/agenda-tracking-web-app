@extends('v2.layout.login-layout')


@section('title', 'Agenda WEB | Login to continue')

@section('styles')

@endsection

@section('main-content')
    <div class="grid grid-cols-3 gap-2">
        <div class="col-span-3 md:hidden">
            <div class="flex justify-start mt-2 ml-3">
                <h1 class="text-3xl font-bold text-indigo-700">Hello World!</h1>
            </div>
        </div>
        <div class="col-span-3 md:col-span-2 p-4">
            @include('v2.ui.login-ui')
        </div>
        <div class="md:flex hidden justify-end p-6 mt-2 mr-4">
            <h1 class="text-3xl font-bold text-indigo-700">Hello World!</h1>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/modules/login.js') }}"></script>
@endsection