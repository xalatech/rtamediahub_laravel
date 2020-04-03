@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header">Add new post</div>
                <form method="post" action="/submit_post" enctype="multipart/form-data">
                  
                <div class="card-body">
                        @csrf

                        <div class="form-group row">
                            <label for="headline" class="col-sm-2 col-form-label text-md-left">{{ __('Headline') }}</label>

                            <div class="col-md-10">
                                <input id="headline" type="text" class="form-control @error('headline') is-invalid @enderror" name="headline" value="{{ old('headline') }}" required autocomplete="headline" autofocus>

                                @error('headline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-2 col-form-label text-md-left">{{ __('Category') }}</label>

                            <div class="col-md-10">
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                       <option value="{{$category->id}}">{{$category->name}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label text-md-left">{{ __('Description') }}</label>

                            <div class="col-md-10">
                                <textarea class="textarea" id="summernote" name="description"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-sm-2 col-form-label text-md-left">{{ __('Tags') }}</label>

                            <div class="col-md-10">
                                <input id="tags" type="text" class="form-control" name="tags" value="{{ old('tags') }}" autocomplete="tags">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upload_url" class="col-sm-2 col-form-label">Media</label>
                            <div class="col-sm-10">
                                <input name="upload_url" type="file" id="upload_url" >
                            </div>
                        </div>

                       
                    
                </div>
                    <div class="card-footer">
                        <div class="flex-container center">
                        <button type="submit" class="btn btn-success col-lg-3">Save Post</button>
                         <a href="/" type="button" class="btn btn-warning ml-3 col-lg-3">Cancel</a>
         
                        </div>
                       </div>
                   
                </div>
            </form>
            </div>
        </section>
    </div>
</div>
@endsection
