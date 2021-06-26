@extends('admin.layouts.app')
@section('page-title') Index Project @endsection
@section('content')

@push('admincss')
    <!-- <link rel="stylesheet" href="{{url('admin_design')}}/css/chosen/bootstrap-chosen.css"> -->
@endpush

@push('adminjs')
    <!-- <script src="{{url('admin_design')}}/js/chosen/chosen.jquery.js"></script>
    <script src="{{url('admin_design')}}/js/chosen/chosen-active.js"></script> -->
    <script>
    $(document).ready(function(){
        var users_div = $('#users_div');
        users_div.hide();
        $('#status').on('change', function() {
                if(this.value == 'specific_users'){
                    users_div.show();
                }
            });
        });
    </script>
@endpush

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
                                <li>
                                    <span class="bread-blod">Project</span>
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
                            <h1>Project <span class="table-project-n">Data</span> Table <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Create</a></h1> 
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="name">Name</th>
                                        <th data-field="researcher">Reseacher</th>
                                        <th data-field="created_by">Created By</th>
                                        <th data-field="files">Files</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->researcher->name }}</td>
                                    <td>{{ $project->createdBy->name }}</td>
                                    @can('admin.projects.files.index')
                                    <td>
                                        <a href="{{route('admin.projects.files.index',$project->id)}}" class="btn btn-info">Show Files</a>
                                    </td>
                                    @endcan
                                    <td>
                                        @can('admin.projects.show')
                                        <a href="{{route('admin.projects.show',$project->id)}}"><i class="fa fa-eye"></i></a>
                                        @endcan
                                        @can('admin.projects.edit')
                                        <a href="{{route('admin.projects.edit',$project->id)}}"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('admin.projects.destroy')
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
                                                        <form method="POST"  action="{{route('admin.projects.destroy',$project->id)}}">
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