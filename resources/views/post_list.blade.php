@foreach ($posts as $post)
<div class="card child">
<img class="card-img-top" src="{{ asset('uploads/images/').'/'.$post->upload_url }}" alt="{{$post->headline}}">
<div class="card-body">
    <a class="card-title" href="/post/{{$post->slug}}">{{$post->headline}}</a>
    <p class="card-text">{!! \Illuminate\Support\Str::limit($post->description, 145, $end='...') !!}</p>
    <p class="card-text">{{$post->tags}}</p>
    <p class="card-text">{{$post->created_at}}</p>
    <a href="/post/{{$post->slug}}" class="btn btn-default btn-sm">Read more</a>
</div>
</div>
@endforeach