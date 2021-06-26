  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}"><strong>{{ SiteSetting('name') }}</strong></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">



        <form action="{{url('search')}}" method="get" class="form-inline ">
            <div class="form-group mx-sm-3">
              <label for="Search" class="sr-only">Search</label>
              <input type="text" class="form-control" name='search' id="Search" placeholder="Search...">
            </div>
            <button type="submit" class="btn btn-primary">GO!</button>
          </form>



        <ul class="navbar-nav ml-auto">


          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('welcome') ? '' : "text-white" }}  " href="{{ url('/') }}">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('site.teamMember') ? '' : "text-white" }}" href="{{ url('team-members') }}">Team</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('about') ? '' : "text-white" }}" href="{{ route('about') }}">About</a>
          </li>

            @guest
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? '' : "text-white" }}" href="{{ route('login') }}">{{ __('Login') }} </a>
                </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('register') ? '' : "text-white" }}" href="{{ route('register') }}">{{ __('Register') }} </a>
                </li>
            @endif
            
            @else

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle {{ request()->routeIs('profile') ? '' : "text-white" }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                  </a>
                  
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if(Auth::user()->role_id == 1)
                          @can('admin.generalInfo')
                            <a href="{{url('admin/profile?a=general-info')}}" class="dropdown-item">My Account</a>
                          @endcan
                          
                          @can('admin.changePassword')
                         
                              <a href="{{url('admin/profile?a=change-password')}}" class="dropdown-item">Change Password</a>
                          
                          @endcan
                          @can('admin.changeImage')
                              
                            <a href="{{url('admin/profile?a=change-image')}}" class="dropdown-item">Change Image</a>
                              
                          @endcan
                         
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"onclick="event.preventDefault();
                              document.getElementById('admin-logout-form').submit();">
                              <span class="adminpro-icon adminpro-locked author-log-ic"></span>{{ __('Logout') }}
                            </a>
                          
                          <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                    @else
                    
                    <a href="{{url('profile?a=general-info')}}" class="dropdown-item">My Account</a>

                    <a href="{{url('profile?a=change-password')}}" class="dropdown-item">Change Password</a>

                    <a href="{{url('profile?a=change-image')}}" class="dropdown-item">Change Image</a>

                    @if(Auth::user()->role_id == 2)
                      <a href="{{route('researcher.workspaces.index')}}" class="dropdown-item">Projects Dashboard</a>
                    @endif

                    
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endif
                </div>
            </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>

  @if (request()->routeIs('welcome'))
    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active " style="background-image: url('{{ url('site_design') }}/images/1.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>OSW The place to share your research.</h3>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('{{ url('site_design') }}/images/5.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>OSW is a free, open platform to support your research and enable collaboration.</h3>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('{{ url('site_design') }}/images/11.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Discover projects, data, materials, and collaborators on OSF that might be helpful to your own research.
              </h3>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>
  @endif