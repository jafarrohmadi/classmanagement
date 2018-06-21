<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jafar Rohmadi(rohmadijafar@gmail.com)"/>
    <title>Class Management</title>

    <!-- Bootstrap -->
    <link href="{{ asset('desain/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('desain/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('desain/css/nprogress.css') }}" rel="stylesheet">
	  <!-- DataTables -->
    <link href="{{ asset('desain/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Date Picker -->
    <link href="{{ asset('desain/css/datepicker.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('desain/css/select2.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('desain/css/custom.min.css') }}" rel="stylesheet">
     <!-- Custom  Style -->
    <link href="{{ asset('desain/css/my.css') }}" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/user/')}}" class="site_title"><img src="{{ asset('desain/images/logo.png')}}" class="logo-user" > <span class='title-user'>Class Management</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
              @if(Auth::user()->picture)
                <img src="{{ Auth::user()->imageUrl() }}" alt="..." class="img-circle profile_img">
              @else
                <img src="{{ asset('desain/images/user.png')}}" alt="..." class="img-circle profile_img">
              @endif  
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }} </h2>
              </div>
              <div class="clearfix"></div>
            </div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="{{ url('/user/') }}" ><i class="fa fa-home"></i> Home </a></li>
                  <li><a href="{{ url('/user/class') }}" ><i class="fa fa-cog"></i> Class </a></li>
                  <li><a href="{{ url('/user/teacher') }}" ><i class="fa fa-user"></i> Teacher </a></li>
                  <li><a href="{{ url('/user/students') }}" ><i class="fa fa-users"></i> Students </a></li>                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""> {{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ url('user/profile')}}"> Profile</a></li>
                    <li><a href="{{ url('user/change-password')}}"> Change Password</a></li>

                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i>Log Out </a>  </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
          <div class="row">
          <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
          @if(Session::has('flash_message'))      
           <p class="alert {{ Session::get('alert-class', 'alert-info') }} list-unstyled" >{{ Session::get('flash_message') }}</p>
          @endif
          @yield('content')
          </div>
          </div>
        </div>
        <!-- footer content -->
        <footer>
          <div class="pull-right">
           tes kerja kilk.co 27 juli 2018
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('desain/js/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('desain/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('desain/js/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('desain/js/nprogress.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('desain/js/sweetalert.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('desain/js/jquery.dataTables.min.js') }}"></script>
    <!-- Date Picker -->
    <script src="{{ asset('desain/js/datepicker.min.js') }}"></script>
    <!-- Lang Date Picker -->
    <script src="{{ asset('desain/js/datepicker.en.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('desain/js/select2.min.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('desain/js/custom.min.js') }}"></script>
	<!-- Custom Me Scripts -->
    <script src="{{ asset('desain/js/my.js') }}"></script>
    @stack('scripts')
  </body>
</html>
