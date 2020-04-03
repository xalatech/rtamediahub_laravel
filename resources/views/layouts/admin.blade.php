<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RTA - Mediahub</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
   
   <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    
    <script src="{{ asset('js/pages/dashboard.js')}}"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top mb-3 shadow-sm">
            <div class="container">
                    <div class="input-group input-group-sm col-md-4 ml-5">
                      <input class="form-control form-control-navbar" type="search" id="keywordSearch" placeholder="Search" aria-label="Search">
                    </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                         <!-- SEARCH FORM -->
    

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <a href="{{ route('home') }}" class="btn btn-warning mr-3">Switch to main site</a>
                            

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('images/rtalogo.png') }}" class="brand-image img-circle elevation-3" width="50" alt="rta"  style="opacity: .8" />
            
              <span class="brand-text font-weight-light">Mediahub</span>
            </a>
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                       <li class="nav-item">
                      <a href="/admin" class="nav-link active" title="Home">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                          Home
                        </p>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a href="/admin/users" class="nav-link" title="Users">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                          Users
                        </p>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a href="/admin/roles" class="nav-link" title="Roles">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                          User roles
                        </p>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a href="/admin/permissions" class="nav-link" title="Permissions">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                          Permissions
                        </p>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a href="/admin/categories" class="nav-link" title="Categories">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                          Categories
                        </p>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a href="/admin/posts" class="nav-link" title="Posts">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                          Posts
                        </p>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a href="/admin/images" class="nav-link" title="Images">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                          Images
                        </p>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a href="/admin/videos" class="nav-link" title="Videos">
                        <i class="nav-icon fas fa-video"></i>
                        <p>
                          Videos
                        </p>
                      </a>
                    </li>  
        
                  
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>
     
          <main class="content-wrapper">
            @yield('content')
        </main>
    </div>
</div>


</body>
</html>
