@extends('layouts.app')
@section('page-title') Search for {{$project->name}} @endsection
@section('content')
    @if($project->status === "all_users")
      
    @include('site.projectSearch')

    @elseif($project->status === "specific_users")
      @if(session()->has('permission'))

        @include('site.projectSearch')
        
      @endif
    @endif



@endsection