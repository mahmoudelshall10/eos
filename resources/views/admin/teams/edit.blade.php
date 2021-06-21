@extends('admin.layouts.app')
@section('page-title') Edit Team Member @endsection
@section('content')

<!-- Breadcome start-->
<div class="breadcome-area mg-b-30 small-dn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="breadcome-heading">
                                <form role="search" class="">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="breadcome-menu">
                               @can('admin.dashboards.index')
                                <li>
                                    <a href="{{route('admin.dashboards.index')}}">Home</a> <span class="bread-slash">/</span>
                                </li>
								@endcan
                                @can('admin.teams.index')
                                <li>
                                    <a href="{{route('admin.teams.index')}}">Team Members</a> /
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
                            <h1>Edit Team Member Form <a href="{{route('admin.teams.index')}}" class="btn btn-primary">Back</a></h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">
                                        <form action="{{route('admin.teams.update',$team->id)}}"  method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="form-group col-lg-6">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" 
                                                placeholder="Enter Name" value="{{$team->name}}"/>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Job Title</label>
                                                <input type="text" name="job_title" class="form-control" 
                                                placeholder="Enter Job Title" value="{{$team->job_title}}" />
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Facebook URL</label>
                                                <input type="text" name="facebook_url" class="form-control" 
                                                placeholder="Enter Facebook URL" value="{{$team->facebook_url}}" />
                                            </div>

                                             <div class="form-group col-lg-6">
                                                <label>Twitter URL</label>
                                                <input type="text" name="twitter_url" class="form-control" 
                                                placeholder="Enter Twitter URL" value="{{$team->twitter_url}}" />
                                            </div>

                                             <div class="form-group col-lg-6">
                                                <label>LinkedIn URL</label>
                                                <input type="text" name="linkedIn_url" class="form-control" 
                                                placeholder="Enter LinkedIn URL" value="{{$team->linkedIn_url}}" />
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Instagram URL</label>
                                                <input type="text" name="insta_url" class="form-control" 
                                                placeholder="Enter Instagram URL" value="{{$team->insta_url}}" />
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="photo">Photo</label>
                                                <input type="file" name="photo" id="photo" class="form-control">
                                            </div>


                                            <div class="form-group col-lg-12">
                                                <img src="{{url('/').'/'.$team->photo}}" alt="{{$team->name}}">
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