@extends('admin.layouts.app')
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
                                <li><a href="{{route('admin.dashboards.index')}}">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Profile</span>
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

<!-- Basic Form Start -->
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset">
                    <div class="sparkline8-hd">
                        <div class="main-sparkline8-hd">
                            <h1>Settings Form</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">
                                        <form action="{{route('admin.settings.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-lg-6" style="padding-left: 3px;">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{SiteSetting('name')}}"/>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{SiteSetting('email')}}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords</label>
                                                <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" placeholder="Site Meta Keywords" value="{{SiteSetting('meta_keywords')}}">
                                            </div>

                                            <div class="form-group">
				                                <label for="meta_description">Meta Description</label>
				                                <textarea class="form-control"  name="meta_description" rows="2" cols="10" id="meta_description" placeholder="Site Meta Description">{{SiteSetting('meta_description')}}</textarea>
			                                </div>

                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="number" name="phone" id="phone" value="{{SiteSetting('phone')}}" 
                                                min="0" class="form-control" placeholder="Enter Phone">
                                            </div>	

                                            <hr>

                                            <div class="form-row">
                                                
                                                <div class="form-group col-6">
                                                    <label for="logo">Logo
                                                        <img src="{{url('/').'/'.SiteSetting('logo')}}" 
                                                        class="img-fluid pr-2" alt="log" style="width: 50px; height:50px">
                                                    </label>
                                                    <input type="file" name="logo" id="logo">
                                                    
                                                </div>

                                                <hr>
                                                
                                                <div class="form-group col-6">
                                                    <label for="icon">Icon
                                                        <img src="{{url('/').'/'.SiteSetting('icon')}}" class="img-fluid pr-2" alt="icon" style="width: 50px; height:50px">
                                                    </label>
                                                    <input type="file" name="icon" id="icon">
                                                </div>
                                                
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