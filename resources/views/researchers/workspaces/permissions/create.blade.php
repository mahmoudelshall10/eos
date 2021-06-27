@extends('layouts.app')
@section('page-title') Create File Permissions @endsection
@section('content')

@include('flash_messages')

<!-- Basic Form Start -->
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset">
                    <div class="sparkline8-hd">
                        <div class="main-sparkline8-hd">
                            <h1>Create Permissions Form @can('researcher.filespermissions.index')<a href="{{route('researcher.filespermissions.index',$project->id)}}" class="btn btn-primary">Back</a>@endcan</h1>
                        </div>
                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">
                                        <form action="{{route('researcher.filespermissions.store',$project->id)}}"  method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group col-lg-12" id="users_div">
                                                <label>Users</label>
                                                <select id="user" class="form-control chosen-select" name="user_id[]" multiple="multiple">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"{{ !empty(old('user_id')) && in_array($user->id, old('user_id')) ? ' selected="selected"' : '' }}>{{ $user->email }}</option>
                                                    @endforeach
                                                </select>
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