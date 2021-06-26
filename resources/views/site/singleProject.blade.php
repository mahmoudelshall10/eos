@extends('layouts.app')
@section('page-title') Search for {{$project->name}} @endsection
@section('content')
    @if($project->status === "all_users")
      <h1>{{$project->name}}</h1>
      <p>{{$project->description}}</p>
      @foreach($project->files as $file)

          <a href="{{route('download',$file->uuid)}}">{{$file->name}}</a>
          <br>

      @endforeach
    @elseif($project->status === "specific_users")
      @if(session()->has('permission'))
        <h1>{{$project->name}}</h1>
        <p>{{$project->description}}</p>
        @foreach($project->files as $file)

            <a href="{{route('download',$file->uuid)}}">{{$file->name}}</a>
            <br>

        @endforeach
      @endif
    @endif



@endsection