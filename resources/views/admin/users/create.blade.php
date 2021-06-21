@extends('admin.layouts.app')
@section('page-title') Create Users @endsection
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
                            <h1>Create User Form @can('admin.users.index') <a href="{{route('admin.users.index')}}" class="btn btn-primary">Back</a> @endcan</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">
                                        <form action="{{route('admin.users.store')}}"  method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-lg-6">
                                                <label>Name <span style="color: red">*</span></label>
                                                <input type="text" name="name" class="form-control" 
                                                placeholder="Enter Name" value="{{old('name')}}"/>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Email <span style="color: red">*</span></label>
                                                <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{old('email')}}" />
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Phone <span style="color: red">*</span></label>
                                                <input type="number" name="phone" min="0" id="phone" placeholder="Phone" class="form-control" value="{{old('phone')}}"/>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="gender">Gender <span style="color: red">*</span></label>
                                                <select id="gender" class="form-control" name="gender">
                                                    <option value="">Choose Gender</option>
                                                    @foreach(["male" => "Male", "female" => "Female"] AS $gender => $Type)    
                                                        <option value="{{ $gender }}" {{ old("gender") == $gender ? "selected" : "" }}>{{ $Type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            
                                            <div class="form-group col-lg-6">
                                                <label>Role <span style="color: red">*</span></label>
                                                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                                <option value="">Choose Role</option>
                                                    @foreach (\Spatie\Permission\Models\Role::get(); as $role)
                                                        <option value="{{ $role->id }}"  {{ old("role_id") == $role->id ? "selected" : "" }}>{{ ucfirst($role->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-lg-6">
                                                <label for="date_of_birth">Date Of Birth <span style="color: red">*</span></label>
                                                <input type="text" id="datepicker" class="form-control" placeholder="Date Of Birth" name="date_of_birth" autocomplete="off" id="date_of_birth" value="{{old('date_of_birth')}}">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Password <span style="color: red">*</span></label>
                                                <input type="password" name="password" class="form-control" placeholder="Enter Password" value="{{old('password')}}" />
                                            </div>

                                             <div class="form-group col-lg-6">
                                                <label>Password Confirm <span style="color: red">*</span></label>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Password" value="{{old('password_confirmation')}}" />
                                            </div>

                                        

                                            <div class="form-group col-lg-12">
                                                <label for="photo">Photo <span style="color: red">*</span></label>
                                                <input type="file" name="photo" id="photo" class="form-control">
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
@push('adminjs')
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
@endpush