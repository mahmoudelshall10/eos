@extends('admin.layouts.app')
@section('page-title') Create Role @endsection
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
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="breadcome-menu">
								@can('admin.dashboards.index')
									<li>
										<a href="{{route('admin.dashboards.index')}}">Home</a> <span class="bread-slash">/</span>
									</li>
								@endcan
								@can('admin.roles.index')
									<li> 
										<a href="{{route('admin.roles.index')}}">Role</a> /
									</li>
								@endcan
                                <li><span class="bread-blod">Create</span></li>
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
                            <h1>Create Role Form @can('admin.roles.index')<a href="{{route('admin.roles.index')}}" class="btn btn-success">Back</a>@endcan</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
                                    <div class="basic-login-inner">
										{!! Form::open(array('route' => 'admin.roles.store','method'=>'POST')) !!}
											<div class="row">
												<div class="form-row col-12">
													<div class="form-group col-12">
														<label for="inputName">Name</label>
															{!! Form::text('name', null, array('placeholder' => 'Name', 'id'=>'inputName' ,'class' => 'form-control')) !!}
													</div>
												</div>

												@foreach($permission as $value)
													<div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label class="custom-control custom-checkbox m-0">
                                                                {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'custom-control-input')) }}
                                                                <span class="custom-control-label">{{ $value->name }}</span>
                                                            </label>
                                                        </div>
												    </div>
												@endforeach
											
												
												<div class="form-group col-md-12">
													<button type="submit" class="btn btn-primary">Submit</button>
												</div>

											</div>
										{!! Form::close() !!}
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