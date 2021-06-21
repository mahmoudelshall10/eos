@extends('admin.layouts.app')
@section('page-title') Edit Permission @endsection
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
								@can('admin.permissions.index')
									<li> 
										<a href="{{route('admin.permissions.index')}}">Permission</a> /
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
                            <h1>Edit Permission Form  @can('admin.permissions.index') <a href="{{route('admin.permissions.index')}}" class="btn btn-primary">Back</a> @endcan</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">							
									<h6 class="card-subtitle text-muted">ex: <strong>permissions.index</strong> - <strong>permissions.create</strong> - <strong>permissions.show</strong> - 
										<strong>permissions.edit</strong> - <strong>permissions.destroy</strong> 
									</h6>
                                    <div class="basic-login-inner">
										{!! Form::model($permission, ['method' => 'PATCH','route' => ['admin.permissions.update', $permission->id]]) !!}
											<div class="row">
												<div class="form-row col-12">
													<div class="form-group col-12">
														<label for="inputName">Name</label>
															{!! Form::text('name', null, array('placeholder' => 'Name', 'id'=>'inputName' ,'class' => 'form-control')) !!}
													</div>
												</div>
												
												<div class="form-group col-12">
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