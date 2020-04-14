@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
            <section class="col-lg-12 connectedSortable" id="postContent">
              <header class="video-home-page-display-set__header">
                <h3 class="video-home-page-display-set__title">Latest posts today</h3>
                <a class="video-home-page-display-set__link btn btn--hollow" href="/search/sets/gc7j5vVE8kKFbgt23TuAyg#license">
                  {{-- <span class="video-home-page-display-set__link-text">VIEW ALL</span> --}}
                  </a>
              </header>
                      <div class="parent" id="posts">
                        @foreach ($posts_today as $post)
                        <div class="card child">
                            <a href="{{ asset('uploads').$post->upload_url }}" class="posthome" data-toggle="lightbox"> 
                                @if($post->media_type == 'video')
                                    <video width="390" height="219" controls>
                                        <source src="{{ asset('uploads').$post->upload_url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else    
                                    <img class="card-img-top posthome" src="{{ asset('uploads').$post->upload_url }}" alt="{{$post->headline}}">
                                @endif
                            </a>
                            <div class="card-body">
                              <p class="category-badge">{{$post->category->name}}</blockquote>
                                <p class="date-badge">{{date('d-M-y h:m:s', strtotime($post->created_at))}}</blockquote>
                              <p class="card-title">{{$post->headline}}</p>
 
                              <p class="card-text">{{$post->tags}}</p>
                                <p class="card-text">{{$post->createdOn}}</p>
                             
                                <a href="{{ asset('uploads').$post->upload_url }}" onclick="downloadPost({{ $post->id }})" download class="btn btn-secondary btn-sm">Download Media</a>
                            </div>
                          </div>
                          @endforeach
                      </div>
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
                        <div class="card child">
                            <a href="{{ asset('uploads').$post->upload_url }}" class="posthome" data-toggle="lightbox"> 
                                @if($post->media_type == 'video')
                                    <video width="390" height="219" controls>
                                        <source src="{{ asset('uploads').$post->upload_url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                            @else    
                                <img class="card-img-top posthome" src="{{ asset('uploads').$post->upload_url }}" alt="{{$post->headline}}">
                            @endif
                            </a>
                            <div class="card-body">
                              <p class="category-badge">{{$post->category->name}}</blockquote>
                                <p class="date-badge">{{date('d-M-y h:m:s', strtotime($post->created_at))}}</blockquote>
                              <p class="card-title">{{$post->headline}}</p>
 
                              <p class="card-text">{{$post->tags}}</p>
                                <p class="card-text">{{$post->createdOn}}</p>
                             
                                <a href="{{ asset('uploads').$post->upload_url }}" onclick="downloadPost({{ $post->id }})" download class="btn btn-secondary btn-sm">Download Media</a>
                            </div>
                          </div>
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
                        <div class="card child">
                            <a href="{{ asset('uploads').$post->upload_url }}" class="posthome" data-toggle="lightbox"> 
                                @if($post->media_type == 'video')
                                    <video width="390" height="219" controls>
                                        <source src="{{ asset('uploads').$post->upload_url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else    
                                    <img class="card-img-top posthome" src="{{ asset('uploads').$post->upload_url }}" alt="{{$post->headline}}">
                                @endif
                            </a>
                            <div class="card-body">
                              <p class="category-badge">{{$post->category->name}}</blockquote>
                                <p class="date-badge">{{date('d-M-y h:m:s', strtotime($post->created_at))}}</blockquote>
                              <p class="card-title">{{$post->headline}}</p>
 
                              <p class="card-text">{{$post->tags}}</p>
                                <p class="card-text">{{$post->createdOn}}</p>
                             
                                <a href="{{ asset('uploads').$post->upload_url }}" onclick="downloadPost({{ $post->id }})" download class="btn btn-secondary btn-sm">Download Media</a>
                            </div>
                          </div>
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
