@extends('admin.layouts.app')
@section('page-title') Index Project @endsection
@section('content')




<!-- Breadcome start-->
<div class="breadcome-area mg-b-30 small-dn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu">
                                @can('admin.dashboards.index')
                                <li>
                                    <a href="{{route('admin.dashboards.index')}}">Home</a> <span class="bread-slash">/</span>
                                </li>
								@endcan
                                @can('admin.projects.files.index')
                                <li>
                                    <a href="{{route('admin.projects.index')}}">Project</a> /
                                </li>
                                @endcan
                                <li>
                                    <span class="bread-blod">Files</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcome End-->

@include('flash_messages')

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Project Files <span class="table-project-n">Data</span> Table <a href="{{route('admin.projects.files.create',$project->id)}}" class="btn btn-primary">Create</a></h1> 
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="name">Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($project->files as $file)
                                <tr>
                                    <td>{{ $file->name }}</td>
                                    <td>
                                    @can('admin.projects.files.edit')
                                    <a href="{{route('admin.projects.files.edit',[$project->id,$file->id])}}"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('admin.projects.files.destroy')
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
                                                    <form method="POST"  action="{{route('admin.projects.files.destroy',[$project->id,$file->id])}}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Static Table End -->

@endsection