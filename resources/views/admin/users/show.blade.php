@extends('admin.layouts.app')
@section('page-title') Show User @endsection
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
								@can('admin.users.index')
									<li> 
										<a href="{{route('admin.users.index')}}">User</a> /
									</li>
								@endcan
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
                            <h1>Show User Form @can('admin.users.index')<a href="{{route('admin.users.index')}}" class="btn btn-primary">Back</a> @endcan</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="basic-login-inner">
                                        <p><strong>Name: </strong> {{$user->name}}</p>
                                        <p><strong>Email: </strong> {{$user->email}}</p>
                                        <p><strong>Phone: </strong>
                                            @isset($user->phone)
                                                <p>{{ $user->phone }}</p>
                                            @else
                                                Not Found
                                            @endisset
                                        </p>

                                        <p><strong>Gender: </strong>
                                            @isset($user->gender)
                                                <p>{{ ucfirst($user->gender) }}</p>
                                            @else
                                                Not Found
                                            @endisset
                                        </p>

                                        <p><strong>Photo: </strong>
                                            @isset($user->photo)
                                                <img src="{{url('/').'/'.$user->photo}}" alt="{{$user->name}}">
                                            @else
                                                Not Found
                                            @endisset
                                        </p>

                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="basic-login-inner">
                                        <p><strong>Role Name: </strong> {{ ucfirst($user->role->name) }}</p>
                                        <p><strong>Date Of Birth: </strong>
                                            @isset($user->date_of_birth)
                                                <p>{{$user->date_of_birth}}</p>
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