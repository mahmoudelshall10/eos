@extends('layouts.app')
@section('page-title') Search for {{$project->name}} @endsection
@section('content')
    @if($project->status === "all_users")
      
    @include('site.projectSearch')

    @elseif($project->status === "specific_users")
    @include('site.projectSearch')
    @endif



@endsection