@extends('admin.layouts.app')
@section('content')

<!-- Breadcome start-->
<div class="breadcome-area mg-b-30 small-dn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu">
                                <li><a href="{{route('admin.dashboards.index')}}">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Dashboard</span>
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



<!-- income order visit user Start -->
<div class="income-order-visit-user-area">
    <div class="container-fluid">
        <div class="row">

            
            <div class="col-lg-3">
                <div class="income-dashone-total income-monthly shadow-reset nt-mg-b-30">
                    
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Admins</h2>
                        </div>
                    </div>

                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter">{{$admins}}</span></h3>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="income-dashone-total income-monthly shadow-reset nt-mg-b-30">
                    
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Users</h2>
                        </div>
                    </div>

                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter">{{$users}}</span></h3>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="income-dashone-total orders-monthly shadow-reset nt-mg-b-30">
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Researcher</h2>
                        </div>
                    </div>
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter">{{$researchers}}</span></h3>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="income-dashone-total visitor-monthly shadow-reset nt-mg-b-30">
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Team Members</h2>
                        </div>
                    </div>

                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter">{{$teams}}</span></h3>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="income-dashone-total user-monthly shadow-reset nt-mg-b-30">
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Role</h2>
                        </div>
                    </div>
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter">{{$roles}}</span></h3>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

             <div class="col-lg-3">
                <div class="income-dashone-total user-monthly shadow-reset nt-mg-b-30">
                    <div class="income-title">
                        <div class="main-income-head">
                            <h2>Permissions</h2>
                        </div>
                    </div>
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-adminpro-rate">
                                <h3><span class="counter">{{$permissions}}</span></h3>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- income order visit user End -->

@endsection