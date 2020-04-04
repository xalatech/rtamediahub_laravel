@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <b>{{ $post->headline }}</b>
                  <a href="{{  route('home')  }}" type="button" style="margin-bottom: -5px;" class="btn btn-success float-right">Back to home</a>
                </div><!-- /.card-header -->
                
                <div class="card-body">
                        <img class="card-img-top" src="{{ asset('uploads/images/').'/'.$post->upload_url }}" alt="{{$post->headline}}">
                        <div class="card-body">
                            <p class="card-text">{!! $post->description !!}</p>
                            <p class="card-text">{{$post->tags}}</p>
                            <p class="card-text">{{$post->created_at}}</p>
                </div><!-- /.card-body -->
                <div class="card-footer">
                  <div class="flex-container center">
                    <a href="{{  route('home')  }}" type="button" class="btn btn-success ml-3 col-lg-3">Back to home</a>
                  </div>
                 </div>
              </div>
            </section>
         
          </div>
        </div><!-- /.container-fluid -->
      </section>
@endsection
