@extends('admin.layouts.app')
@section('page-title') Show Team Member @endsection
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
                                <li><a href="{{route('admin.teams.index')}}">Team Members</a> /</li>
                                <li><span class="bread-blod">Show</span></li>
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
                            <h1>Show Team Member Form <a href="{{route('admin.teams.index')}}" class="btn btn-primary">Back</a></h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="basic-login-inner">
                                        <p><strong>Name: </strong> {{$team->name}}</p>
                                        <p><strong>Created By: </strong> {{$team->createdBy->name}}</p>
                                        <p><strong>Twitter URL: </strong>
                                            @isset($team->twitter_url)
                                                <a href="{{$team->twitter_url}}" target="_blank" class="btn btn-primary"><i class="fa fa-twitter"></i></a>
                                            @else
                                                Not Found
                                            @endisset
                                        </p>

                                        <p><strong>LinkedIn URL: </strong>
                                            @isset($team->linkedIn_url)
                                                <a href="{{$team->linkedIn_url}}" target="_blank" class="btn btn-info"><i class="fa fa-linkedin"></i></a>
                                            @else
                                                Not Found
                                            @endisset
                                        </p>

                                        <p><strong>Photo: </strong>
                                            @isset($team->photo)
                                                <img src="{{url('/').'/'.$team->photo}}" alt="{{$team->name}}">
                                            @else
                                                Not Found
                                            @endisset
                                        </p>

                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="basic-login-inner">
                                        <p><strong>Job Title: </strong> {{$team->job_title}}</p>
                                        <p><strong>Facebook URL: </strong>
                                            @isset($team->facebook_url)
                                                <a href="{{$team->facebook_url}}" target="_blank" class="btn btn-primary"><i class="fa fa-facebook"></i></a>
                                            @else
                                                Not Found
                                            @endisset
                                        </p>

                                          <p><strong>Instagram URL: </strong>
                                            @isset($team->insta_url)
                                                <a href="{{$team->insta_url}}" target="_blank" class="btn btn-danger"><i class="fa fa-instagram"></i></a>
                                            @else
                                                Not Found
                                            @endisset
                                        </p>
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