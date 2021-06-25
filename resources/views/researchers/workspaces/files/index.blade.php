@extends('layouts.app')
@section('page-title') Index Project Files @endsection
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
        <a href="{{route('researcher.workspaces.files.create',$project->id)}}" type="button" class="btn btn-primary btn-lg">Create</a>
        <a href="{{route('researcher.workspaces.index')}}" type="button" class="btn btn-success btn-lg">Back</a>
    </div>
</div>
<br>
<table class="table table-bordered text-center">
    <thead class="thead-dark ">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Created at</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($project->files as $file)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $file->name }}</td>
            <td>{{ $file->created_at }}</td>
            <td>
                @can('researcher.workspaces.files.edit')
                <a href="{{route('researcher.workspaces.files.edit',[$project->id,$file->id])}}"><i class="fa fa-pencil"></i></a>
                @endcan
                @can('researcher.workspaces.files.destroy')
                <a href="#deModal{{$file->id}}" data-toggle="modal"><i class="fa fa-trash"></i></a>
                <div class="modal fade" id="deModal{{$file->id}}" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Confirmation
                                        <a class="close" data-dismiss="modal" href="#">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this record?</p>
                            </div>
                            <div class="modal-footer">
                                <form method="POST"  action="{{route('researcher.workspaces.files.destroy',[$project->id,$file->id])}}">
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