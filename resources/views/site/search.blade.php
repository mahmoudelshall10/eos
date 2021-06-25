@extends('layouts.app')
@section('page-title') Search for {{ request()->search }} @endsection
@section('content')

<br>


@foreach($projects as $project)

    <a href="{{route('singleProject',$project->uuid)}}">{{$project->name}}</a>

@endforeach

@endsection