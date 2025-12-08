@extends('v2.layout.content-layout')

    @section('content-head-text', 'Profile Settings')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
        @include('v2.ui.settings.profile.edit')
    @endsection