@extends('admin.layouts.app')
@section('page-title') Edit Project Files @endsection
@section('content')


<!-- Breadcome start-->
<div class="breadcome-area mg-b-30 small-dn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu">
                                @can('admin.dashboards.index')
                                <li>
                                    <a href="{{route('admin.dashboards.index')}}">Home</a> <span class="bread-slash">/</span>
                                </li>
								@endcan
                                @can('admin.projects.index')
                                <li>
                                    <a href="{{route('admin.projects.index')}}">Project</a> /
                                </li>
                                @endcan
                                @can('admin.projects.files.index')
                                <li>
                                    <a href="{{route('admin.projects.files.index',$project->id)}}">Files</a> /
                                </li>
                                @endcan
                                <li><span class="bread-blod">Edit</span></li>
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

<!-- Basic Form Start -->
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset">
                    <div class="sparkline8-hd">
                        <div class="main-sparkline8-hd">
                            <h1>Create Project Form @can('admin.projects.files.index')<a href="{{route('admin.projects.files.index',$project->id)}}" class="btn btn-primary">Back</a>@endcan</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">
                                        <form action="{{route('admin.projects.files.update',[$project->id,$file->id])}}"  method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="form-group col-lg-12">
                                                <label for="file_path">Project File</label>
                                                <input type="file" class="form-control" name="file_path" id="file_path">
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <p>{{ $file->name  }}</p>
                                            </div>


                                            <div class="login-btn-inner">
                                                <div class="inline-remember-me">
                                                    <button class="btn btn-sm btn-primary pull-right login-submit-cs" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Basic Form End-->

@endsection