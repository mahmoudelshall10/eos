@extends('admin.layouts.app')
@section('page-title') Edit Project @endsection
@section('content')

@push('admincss')
    <link rel="stylesheet" href="{{url('admin_design')}}/css/chosen/bootstrap-chosen.css">
@endpush

@push('adminjs')
    <script src="{{url('admin_design')}}/js/chosen/chosen.jquery.js"></script>
    <script src="{{url('admin_design')}}/js/chosen/chosen-active.js"></script>
    <script>
    $(document).ready(function(){
        var users_div = $('#users_div');
        users_div.hide();
        if($('#status').val() == 'specific_users')
        {
            users_div.show();
        }else{
            users_div.hide(); 
        }
        $('#status').on('change', function() {
                if(this.value == 'specific_users'){
                    users_div.show();
                }else{
                    users_div.hide(); 
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
                            <h1>Create Project Form @can('admin.projects.index')<a href="{{route('admin.projects.index')}}" class="btn btn-primary">Back</a>@endcan</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">
                                    <form action="{{route('admin.projects.update',$project->id)}}"  method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="form-group col-lg-12">
                                                 <label for="name"><h4>Name</h4></label>
                                                <input type="text" name="name" id="name" class="form-control" 
                                                placeholder="Enter Name" value="{{$project->name}}"/>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Researcher</label>
                                                <select name="researcher_id" id="researcher_id" class="form-control chosen-select @error('researcher_id') is-invalid @enderror">
                                                    <option value="">Choose Researcher</option>
                                                    @foreach ($researchers as $researcher)
                                                        <option value="{{ $researcher->id }}"  {{ $project->researcher_id == $researcher->id ? "selected" : "" }}>{{ ucfirst($researcher->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

 
                                            <div class="form-group col-lg-6">
                                                <label><h4>Categories</h4></label>
                                                <select name="category_id[]" id="category_id" class="form-control chosen-select @error('category_id') is-invalid @enderror"  multiple="multiple">
                                                    @foreach ($categories as $category)
                                                        @if(in_array($category->id, $categoryIds))
                                                            <option value="{{ $category->id }}"  selected>{{ ucfirst($category->name) }}</option>
                                                        @else
                                                            <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label>Project Status</label>
                                                <select id="status" class="form-control chosen-select" name="status">
                                                    <option value="">Choose Status</option>
                                                    @foreach(['hidden' => "Hidden", 'specific_users' => "Specific Users", 'all_users' => "All Users"] as $status => $name)    
                                                        <option value="{{ $status }}" {{$project->status == $status ? "selected" : "" }}>{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-12" id="users_div">
                                                <label>Users</label>
                                                <select id="user" class="form-control chosen-select" name="user_id[]" multiple="multiple">
                                                @foreach ($users as $user)
                                                    @if(in_array($user->id, $userIds))
                                                        <option value="{{ $user->id }}"  selected>{{ ucfirst($user->email) }}</option>
                                                    @else
                                                        <option value="{{ $user->id }}">{{ ucfirst($user->email) }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="description"><h4>Description</h4></label>
                                                <textarea name="description" id="description" class="form-control" 
                                                placeholder="Enter Description">{{$project->description}}</textarea>
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

