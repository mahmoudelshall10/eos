@extends('layouts.app')
@section('page-title') {{ ucfirst(Auth::user()->role->name) }} Profile @endsection
@section('content')

@include('flash_messages')
<div class="row text-center">
    <div class="col">
        <h1>{{ ucfirst(Auth::user()->name)}} - {{ucfirst(Auth::user()->role->name)}}</h1>
    </div>
</div>

@if(request('a') == 'general-info')
    @include('site.profile.general-info')
@endif

@if(request('a') == 'change-password')
    @include('site.profile.change-password')
@endif

@if(request('a') == 'change-image')
    @include('site.profile.change-image')
@endif



@endsection