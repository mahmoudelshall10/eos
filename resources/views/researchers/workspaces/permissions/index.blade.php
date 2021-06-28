@extends('layouts.app')
@section('page-title') Create File Permissions @endsection
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
            @can('researcher.workspaces.index')
                <a href="{{route('researcher.workspaces.index')}}" type="button" class="btn btn-primary">Back</a>
            @endcan
            @can('researcher.filespermissions.create')
                <a href="{{route('researcher.filespermissions.create',$project_id)}}" type="button" class="btn btn-success">Create</a>
            @endcan
        </div>
    </div>
    <br>
    <table class="table table-bordered text-center display" id="dynamic-table">
        <thead class="thead-dark ">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            @can('researcher.filespermissions.changePermission')
                <th scope="col">Change Permission</th>
            @endcan
            @can('researcher.filespermissions.destroy')
                <th scope="col">Delete Permission</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $project->user->name }}</td>
                    <td>{{ $project->status }}</td>
                    @can('researcher.filespermissions.changePermission')
                        <td>
                            <a href="#deModal{{$loop->index + 1}}" data-toggle="modal" class="btn btn-success">Change Status</a>
                            <div class="modal fade" id="deModal{{$loop->index + 1}}" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Confirmation</h5>
                                                    <a class="close" data-dismiss="modal" href="#">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to change this record?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST"  action="{{route('researcher.filespermissions.changePermission')}}">
                                                @csrf
                                                <input type="hidden" name="project_id" value="{{$project->project_id}}">
                                                <input type="hidden" name="email" value="{{$project->user->email}}">
                                                <button type="submit" class="btn btn-danger">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                     @endcan
                     @can('researcher.filespermissions.destroy')
                        <td>
                            <a href="#deModaldelete{{$loop->index + 1}}" data-toggle="modal" class="btn btn-danger">Delete</a>
                            <div class="modal fade" id="deModaldelete{{$loop->index + 1}}" role="dialog">
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
                                            <form method="POST"  action="{{route('researcher.filespermissions.destroy',$project->project_id)}}">
                                                @csrf
                                                @method('Delete')
                                                <input type="hidden" name="email" value="{{$project->user->email}}">
                                                <button type="submit" class="btn btn-danger">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    @endcan
                </tr>
        @endforeach
        </tbody>
    </table>

</div>

@endsection