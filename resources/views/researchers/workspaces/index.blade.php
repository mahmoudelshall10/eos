@extends('layouts.app')
@section('page-title') Index Workspace @endsection
@section('content')


@include('flash_messages')

<div class="container container1">

<div class="row">
    <div class="col">
    <div class="text-center">
        <h1>Dashboard</h1>
    </div>
    </div>

    <div class="col text-center">
    <a href="{{route('researcher.workspaces.create')}}" type="button" class="btn btn-primary btn-lg">Create new project</a>
    </div>
</div>
<br>
<table class="table table-bordered text-center">
    <thead class="thead-dark ">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Modified at</th>
        <th scope="col">Files</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($projects as $project)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->created_at }}</td>
                <td>
                    @can('researcher.workspaces.files.index')
                    <a href="{{route('researcher.workspaces.files.index',$project->id)}}" class="btn btn-info">Show Files</a>
                    @endcan
                </td>
                <td>
                    @can('researcher.workspaces.show')
                    <a href="{{route('researcher.workspaces.show',$project->id)}}"><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('researcher.workspaces.edit')
                    <a href="{{route('researcher.workspaces.edit',$project->id)}}"><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('researcher.workspaces.destroy')
                    <a href="#deModal{{$project->id}}" data-toggle="modal"><i class="fa fa-trash"></i></a>
                    <div class="modal fade" id="deModal{{$project->id}}" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Confirmation</h5>
                                            <a class="close" data-dismiss="modal" href="#">
                                            <i class="fa fa-close"></i>
                                        </a>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this record?</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST"  action="{{route('researcher.workspaces.destroy',$project->id)}}">
                                        @csrf
                                        @method('Delete')
                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                </td>
            </tr>
    @endforeach
    </tbody>
</table>

</div>

  @endsection