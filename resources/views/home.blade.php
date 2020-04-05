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
