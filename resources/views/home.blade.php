@extends('layouts.app', ['searchbar' => true])
@extends('layouts.jumbotron')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
            <section class="col-lg-12 connectedSortable" id="postContent">
              @if(count($posts_today) > 0)
              <header class="video-home-page-display-set__header">
                <h3 class="video-home-page-display-set__title">Today</h3>
                <a class="video-home-page-display-set__link btn btn--hollow" href="/search/sets/gc7j5vVE8kKFbgt23TuAyg#license">
                  {{-- <span class="video-home-page-display-set__link-text">VIEW ALL</span> --}}
                  </a>
              </header>
                      <div class="parent" id="posts">
                        @foreach ($posts_today as $post)
                          @include('partials.post', ['post' => $post])
                          @endforeach
                      </div>
              @endif
                      @foreach ($featured as $category)
                      <header class="video-home-page-display-set__header">
                        <h3 class="video-home-page-display-set__title">{{ $category->name }} updates</h3>
                       {{--  <a class="video-home-page-display-set__link btn btn--hollow">
                           <span class="video-home-page-display-set__link-text">VIEW ALL</span> 
                          </a> --}}
                      </header>
                      <div class="parent" id="posts">
                        @foreach ($posts as $post)
                        @if($post->category_id == $category->id)
                        @include('partials.post', ['post' => $post])

                          @endif
                          @endforeach
                         
                     </div>
                    
                      @endforeach

                      <header class="video-home-page-display-set__header">
                        <h3 class="video-home-page-display-set__title">Other news</h3>
                       {{--  <a class="video-home-page-display-set__link btn btn--hollow" href="/search/sets/gc7j5vVE8kKFbgt23TuAyg#license">
                           <span class="video-home-page-display-set__link-text">VIEW ALL</span>
                          </a> --}}
                      </header>
                      <div class="parent" id="posts">
                        @foreach ($posts_other as $post)
                        @include('partials.post', ['post' => $post])

                          @endforeach
                      </div>

            </section>
         
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <script type="text/javascript">
        $(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
      
        </script>
@endsection
