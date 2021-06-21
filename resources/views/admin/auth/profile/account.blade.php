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
								@can('dashboards.index')
									<li>
										<a href="{{route('admin.dashboards.index')}}">Home</a> <span class="bread-slash">/</span>
									</li>
								@endcan
                                <li><span class="bread-blod">Profile Account</span></li>
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
@if(request('a') == 'general-info')
    @include('admin.auth.profile.general-info')
@endif

@if(request('a') == 'change-password')
    @include('admin.auth.profile.change-password')
@endif

@if(request('a') == 'change-image')
    @include('admin.auth.profile.change-image')
@endif

@endsection