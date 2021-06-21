<!-- Header top area start-->
<div class="content-inner-all">
    <div class="header-top-area">
        <div class="fixed-header-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="admin-logo logo-wrap-pro">
                            <a href="{{url('/')}}"><img src="{{url('/').'/'.SiteSetting('logo')}}" alt="{{SiteSetting('name')}}" />
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="header-right-info">
                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                <li class="nav-item">
                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                        <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                        <span class="admin-name">{{Auth::user()->name}}</span>
                                        <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX" >
                                        @can('admin.generalInfo')
                                            <li>
                                                <a href="{{url('admin/profile?a=general-info')}}"><span class="adminpro-icon adminpro-home-admin author-log-ic"></span>My Account</a>
                                            </li>
                                        @endcan
                                        
                                        @can('admin.changePassword')
                                        <li>
                                            <a href="{{url('admin/profile?a=change-password')}}"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Change Password</a>
                                        </li>
                                        @endcan
                                        @can('admin.changeImage')
                                            <li>
                                                <a href="{{url('admin/profile?a=change-image')}}"><span class="adminpro-icon adminpro-user-rounded author-log-ic"></span>Change Image</a>
                                            </li>
                                        @endcan
                                        <li><a href="{{ route('admin.logout') }}"onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <span class="adminpro-icon adminpro-locked author-log-ic"></span>{{ __('Logout') }}</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header top area end-->