  <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top shadow-sm justify-content-center landing-top-menu">
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
  