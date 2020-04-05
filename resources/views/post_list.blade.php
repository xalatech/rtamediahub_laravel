@foreach ($posts as $post)
<div class="card child">
<a href="{{ asset('uploads/images/').'/'.$post->upload_url }}" data-toggle="lightbox"> <img class="card-img-top posthome" src="{{ asset('uploads/images/').'/'.$post->upload_url }}" alt="{{$post->headline}}"></a>
<a class="card-title image-overlay" href="/post/{{$post->slug}}">{{$post->headline}}</a>
</div>
@endforeach