@foreach ($posts as $post)
<div class="card child">
   <a href="{{ asset('uploads').$post->upload_url }}" data-toggle="lightbox"> 
    @if($post->media_type == 'video')
        <video style="margin-top:-30px;" width="320" height="240" controls>
            <source src="{{ asset('uploads').$post->upload_url }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @else    
        <img class="card-img-top posthome" src="{{ asset('uploads').$post->upload_url }}" alt="{{$post->headline}}">
    @endif

    </a>
<a class="card-title image-overlay" href="/post/{{$post->slug}}">{{$post->headline}}</a>
</div>
@endforeach