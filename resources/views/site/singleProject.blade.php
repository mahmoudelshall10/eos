@extends('layouts.app')
@section('page-title') Search for {{$project->name}} @endsection
@section('content')

    @if($project->status == )

        @if($project->status == 1)

            <h1>{{$project->name}}</h1>
            <p>{{$project->description}}</p>

            @foreach($project->files as $file)

                <a href="{{route('download',$file->uuid)}}">{{$file->name}}</a>
                <br>

            @endforeach

        @endif
    @endif
    <a class="btn btn-primary" href="">Permission to Access</a>


    if(Auth::check() && Auth::user()->role_id == 3)
        {

            switch ($project->status) {
                case 'hidden':
                    return redirect('403');
                  break;
                case 'specific_users':
                  

                    
                  break;
                case label3:
                  code to be executed if n=label3;
                  break;
                  ...
                default:
                  code to be executed if n is different from all labels;
              }
        }
        

@endsection