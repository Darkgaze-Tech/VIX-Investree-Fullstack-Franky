@extends('layouts.app')
   
@section('content')
    <div class="row text-center">
        <div class="col-lg-12">
            <h2>Edit Post</h2>
        </div>
    </div>
    <div class="row justify-content-center d-grid mx-auto">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('posts') }}">Back</a>
        </div>
    </div>
   <br>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('posts.update',$post->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <div class="form-group">
                    <label for="categories">Category</label>
                    <select class="form-control" id="categories" name="category_id" disabled>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if($category->id == $post->category_id)
                        selected 
                        @endif
                        >{{ $category->id }} - {{ $category->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <div class="form-group">
                    <strong>Title</strong>
                    <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <div class="form-group">
                    <strong>Content</strong>
                    <textarea class="form-control" style="height:150px" name="content" placeholder="Content">{{ $post->content }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <div class="form-group">
                    <label for="formFile" class="form-label">Input Image File</label>
                    <input class="form-control" type="file" id="formFile" name="image" accept="image/*" value="{{ $post->image }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
   
    </form>
@endsection