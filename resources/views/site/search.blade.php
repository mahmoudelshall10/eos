@extends('layouts.app')
@section('page-title') Search for {{ request()->search }} @endsection
@section('content')

<table id="dynamic-table" class="table">
    <thead>
        <tr>
            <th>Search for {{ request()->search }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>
                <a href="{{route('singleProject',$project->uuid)}}">{{$project->name}}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>




@endsection