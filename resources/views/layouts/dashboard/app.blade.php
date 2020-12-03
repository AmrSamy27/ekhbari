<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <!-- <title>@lang('site.dashboard')</title> -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    @if(app()->getLocale() == "ar")
    <link rel="stylesheet" href="{{asset('dist/fonts/fonts-fa.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/rtl.css')}}">
    @else
    @endif
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{route('articles.index')}}" class="logo">
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">@lang('site.ekhbary')</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  @auth
                  <img src="{{asset(Auth::user()->profile_photo_path)}}" class="user-image" alt="{{asset('dist/img/user2-160x160.jpg')}}">
                  <span class="hidden-xs">{{Auth::user()->first_name . ' ' . Auth::user()->last_name}}</span>
                  @else
                  <img src="{{asset('images/defaultProfileImage.png')}}" class="user-image" alt="Profile Photo">
                  <span class="hidden-xs">Guest User</span>
                  @endauth
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                   @auth
                   <img src="{{asset(Auth::user()->profile_photo_path)}}" class="user-image" alt="{{asset('dist/img/user2-160x160.jpg')}}">
                    <p>
                      {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                    <!-- <small>Member since Nov. 2012</small> -->
                    </p>
                    @else
                    <img src="{{asset('images/defaultProfileImage.png')}}" class="user-image" alt="{{asset('dist/img/user2-160x160.jpg')}}">
                    <p>
                      Guest User
                    <!-- <small>Member since Nov. 2012</small> -->
                    </p>
                    <br>
                    <div class="row" style="margin-right:20px;">
                      <a href="{{route('login')}}" style="color:white;float:left;">Login</a>
                      <a href="{{route('register')}}" style="color:white;float:right;">Register</a>
                    </div>
                      @endauth
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
              @auth
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="{{route('dashboard.users.profile.edit',auth()->user()->id)}}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-left">
                      <form action="{{ route('logout') }}" method="post">
                        @csrf
                    <button type="submit" id = "logout" class="btn btn-default btn-flat">Logout</button></form>
                    </div>
                  </li>
                </ul>
              </li>
              @endauth
              <!-- Control Sidebar Toggle Button -->
             
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
         @auth 
         <div class="user-panel" >
            <div class="pull-right image"style="margin-bottom: 20px;">
            <img src="{{asset(Auth::user()->profile_photo_path)}}" class="user-image" alt="{{asset('dist/img/user2-160x160.jpg')}}">
            </div>
            <div class="pull-left info">
              <p>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
              <a href="#"> (@foreach(auth()->user()->roles as $user_role){{Lang::get('site.' . $user_role->display_name)}},@endforeach)</a>
            </div>
          </div>
          @else
          <div class="user-panel" >
            <div class="pull-right image">
            <img src="{{asset('images/defaultProfileImage.png')}}" class="user-image" alt="{{asset('dist/img/user2-160x160.jpg')}}">
            </div>
            <div class="pull-left info">
              <p>Guest User</p>
            </div>
          </div>
          @endauth
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
        @auth
            @if(auth()->user()->hasPermission('writers-read'))
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>@lang('site.TheUsers')</span>
                <span class="label label-primary pull-left">۴</span>
              </a>
              <ul class="treeview-menu">
            @if(auth()->user()->hasPermission('users-read'))
              @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                <li><a href="{{route('dashboard.users.index','all')}}"><i class="fa fa-circle-o"></i> @lang('site.allUsers')</a></li>
                @if(auth()->user()->hasRole('super_admin'))
                <li><a href="{{route('dashboard.users.index','admins')}}"><i class="fa fa-circle-o"></i> @lang('site.Admins')</a></li>
                @endif
                <li><a href="{{route('dashboard.users.index','editors')}}"><i class="fa fa-circle-o"></i> @lang('site.Editors')</a></li>
                <li><a href="{{route('dashboard.users.index','users')}}"><i class="fa fa-circle-o"></i> @lang('site.TheUsers')</a></li>
              @endif
              @endif
                <li><a href="{{route('dashboard.users.index','writers')}}"><i class="fa fa-circle-o"></i> @lang('site.Writers')</a></li>
              
              </ul>
            </li>
            @endif 
        @endauth
        <li class=" treeview">
              <a href="{{route('articles.index')}}">
                <i class="fa fa-dashboard"></i> <span>@lang('site.Articles')</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
            </li>
        <li class=" treeview">
              <a href="{{route('articles.gallery')}}">
                <i class="fa fa-dashboard"></i> <span>@lang('site.ArticlesGalleries')</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
            </li>  
            <li class="treeview">
              <a href="{{route('departments.index')}}">
                <i class="fa fa-dashboard"></i> <span>@lang('site.Departments')</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
            </li>
          </ul>
          <div class="fb-page user-panel" data-href="https://www.facebook.com/facebook" data-tabs="timeline,events,messages" data-width="" data-height="350px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="color:#5F5F5F;">
     
        @yield('content')
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        

        <strong>Copyright &copy; 2020-2021 <a href="#">Ekhbary</a>.</strong> All rights reserved.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
     <!--logout  -->
     <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&autoLogAppEvents=1&version=v9.0&appId=616652995803694" nonce="Gj5NJiwH"></script>

    <!-- Bootstrap 3.3.4 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{asset('plugins/morris/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/app.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
  </body>
</html>
