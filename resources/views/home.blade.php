@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                    <a href="{{  route('add_post')  }}" class="btn btn-info">Add new Post</a>
                    <div class="card-tools">
                    <div class="d-flex">
                    <ul class="nav nav-pills" style="margin-top:0px;">
                       <select id="id_category">
                           <option value="0">All Posts</option>
                           @foreach ($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                       </select>
                    </ul>
                    <button type="button" class="btn btn-secondary daterange ml-3 mt-1" data-toggle="tooltip" id="reportrange" title="Date range">
                       <i class="far fa-calendar-alt"></i>  <span class="ml-2">Filter by date</span>
                    </button>
                  </div>
                  </div>
                 </div><!-- /.card-header -->
                
                <div class="card-body">
                      <div class="parent" id="posts">
                        @foreach ($posts as $post)
                       
                        <div class="card child">
                        <a href="/post/{{$post->slug}}"> <img class="card-img-top posthome" src="{{ asset('uploads/images/').'/'.$post->upload_url }}" alt="{{$post->headline}}"></a>
                        <div class="card-body">
                            <a class="card-title" href="/post/{{$post->slug}}">{{$post->headline}}</a>
                            <p class="card-text">{!! \Illuminate\Support\Str::limit($post->description, 145, $end='...') !!}</p>
                            <p class="card-text">{{$post->tags}}</p>
                            <p class="card-text">{{$post->created_at}}</p>
                            <a href="/post/{{$post->slug}}" class="btn btn-default btn-sm">Read more</a>
                        </div>
                        </div>
                        @endforeach
                </div><!-- /.card-body -->
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
