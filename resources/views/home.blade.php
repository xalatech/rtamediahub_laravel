@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
            <section class="col-lg-12 connectedSortable">
                      <div class="parent" id="posts">
                        @foreach ($posts as $post)
                       
                        <div class="card child">
                        <a href="{{ asset('uploads').$post->upload_url }}" data-toggle="lightbox"> <img class="card-img-top posthome" src="{{ asset('uploads/').$post->upload_url }}" alt="{{$post->headline}}"></a>
                        <a class="card-title image-overlay" href="/post/{{$post->slug}}">{{$post->headline}}</a>
                         
                   {{--      <div class="card-body">
                            <p class="card-text">{!! \Illuminate\Support\Str::limit($post->description, 145, $end='...') !!}</p>
                            <p class="card-text">{{$post->tags}}</p>
                            <p class="card-text">{{$post->created_at}}</p>
                            <a href="/post/{{$post->slug}}" class="btn btn-default btn-sm">Read more</a>
                        </div> --}}
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
