<div class="card child">
    <div class="card-header d-flex badge-header">
        <span class="category-badge">{{$post->category->name}}</span>
        <span class="date-badge ml-auto">{{$post->created_at->diffForHumans()}}</span>
    </div>
    @auth
    <a href="{{ asset('uploads').$post->upload_url }}" class="posthome" data-toggle="lightbox"> 
        @if($post->media_type == 'video')
            <video width="427" height="240" controls>
                <source src="{{ asset('uploads').$post->upload_url }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else    
            <img class="card-img-top posthome" src="{{ asset('uploads').$post->upload_url }}" alt="{{$post->headline}}">
        @endif
    </a>
    @else
    <a href="{{ asset('login') }}" class="posthome" title="You need to login to play/download media."> 
        @if($post->media_type == 'video')
            <video width="427" height="240">
                <source src="{{ asset('uploads').$post->upload_url }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else    
            <img class="card-img-top posthome" src="{{ asset('uploads').$post->upload_url }}" alt="{{$post->headline}}">
        @endif
    </a>
    @endif
    <div class="card-body">
      <p class="card-title">{{$post->headline}}</p>
      <p class="card-text">{{$post->tags}}</p>
    </div>
    <div class="card-footer">
        @auth
        <a href="{{ asset('uploads').$post->upload_url }}" onclick="downloadPost({{ $post->id }})" download class="btn btn-secondary btn-sm">Download Media</a>
        @else
        <a href="{{ route('login') }}" title="You need to login to download media." class="btn btn-secondary btn-sm">Download Media</a>
        @endauth
    </div>
  </div>