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
  <link rel="stylesheet" href="{{ asset('plugins/lightbox/ekko-lightbox.css')}}">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link href="{{ asset('css/feed.css') }}" rel="stylesheet">
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
    <script src="{{ asset('plugins/lightbox/ekko-lightbox.min.js')}}"></script>
    
    <script src="{{ asset('js/pages/dashboard.js')}}"></script>
    <script src="{{ asset('js/jquery.form.js')}}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CG5DH7E6B9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CG5DH7E6B9');
</script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top mb-3 shadow-sm">
            <div class="container">
                 <!-- Brand Logo -->
            <div class="justify-content-center">
            <a href="/" class="brand-link">
              <img src="{{ asset('images/rtalogo.png') }}" class="brand-image img-circle elevation-3" width="80" alt="rta"  style="opacity: .8" />
            Media Hub
          </a>
            </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if($searchbar ?? false)
                    <form method="post" action="" id="search-box" class="col-md-5"> 
                        <input type="text" placeholder="Search media ..." id="keywordSearch" >
                         <span class="inline-search">
                         <i class="fa fa-search"></i>
                        </span>
                        </form>
                        <a class="btn col-md-4 new-media" href="{{ route('add_post') }}">
                          <i class="fa fa-images mr-2"></i>
                          UPLOAD MEDIA
                        </a>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                        @if (Auth::user()->hasRole('manager'))
                        <li class="nav-item mr-3">
                        <a class="btn btn-default" href="{{ route('adminCustom') }}">Switch to admin panel</a>
                        </li>
                     @endif

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
       
        <main class="content-wrapper">
            @yield('content')
        </main>
       
        <footer class="d-none d-sm-block">
          <div class="container">
            <div class="row">

          <div class="col d-flex">
            <div class="footer-left">
              <img src="{{ asset('images/rtalogo.png') }}" class="brand-image img-circle elevation-3" width="80" alt="rta"  style="opacity: .8" />
            </div>
             <div class="footer-left ml-3">
              <p class="footer-links mt-2">RTA Media Hub</p>
              <p>RTA © 2020</p>
              </div>
            </div>

            <div class="col footer-right">
              <a href="https://www.facebook.com/rtaworld" target="_blank"><i class="fab fa-facebook"></i></i></a>
              <a href="https://twitter.com/rtaworld" target="_blank"><i class="fab fa-twitter"></i></a>
              <a href="https://www.instagram.com/worldrta/" target="_blank"><i class="fab fa-instagram"></i></a>
      
            </div>
            <div class="col mt-3 mr-0 right">
             <p class="text-white">Developed by <a href="http://www.xala.no" target="_blank">Xala Technologies</a></p>
            </div>
            
      
          </div>
        </div>
      
        </footer>
    </div>
</div>


</body>
</html>
