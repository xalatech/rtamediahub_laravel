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