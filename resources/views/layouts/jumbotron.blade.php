<div class="jumbotron jumbotron-fluid">
    <div class="row justify-content-center">
      <form method="post" action="" id="search-box" class="col-md-4"> 
        <input type="text" placeholder="Type your keyword here..." id="keywordSearch" >
         <span class="inline-search">
         <button id="search-btn" type="submit" value="Search" ><i class="fa fa-search"></i></button>
        </span>
        </form>
        <a class="btn col-md-2 new-media" href="{{ route('add_post') }}">
          <i class="fa fa-images mr-2"></i>
          UPLOAD MEDIA
        </a>
    </div>
  </div>
  <nav class="navbar navbar-expand navbar-light justify-content-center landing-top-menu site-nav">
    <ul class="navbar-nav">
      <li class="nav-item landing-top-menu__item categories category-0 active" data-id="0">
        <a href="{{ route('home') }}" class="nav-link" title="Home">
          <i class="nav-icon fas fa-home"></i>
            Home
        </a>
      </li>  
      @foreach ($categories as $menu)
      <li class="nav-item landing-top-menu__item categories category-{{$menu->id}} " data-id="{{$menu->id}}">
        <a href="#" class="nav-link" title="{{$menu->description}}">
          <i class="nav-icon fas fa-{{$menu->icon}}"></i>
            {{$menu->name}}
        </a>
      </li>  
      @endforeach
    </ul>
  </nav>