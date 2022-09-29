@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="col-lg-12">
            <h2>Article Posts</h2>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-12">
            <a class="btn btn-success float-end" href="{{ route('posts.create') }}"> <strong>+</strong> Create New Post</a>
        </div>
    </div>
   
    <br>
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
              </button>
              <p>{{ Session::get('message') }}</p>
        </div>
    @endif
    <br>
    <table class="table table-bordered text-center align-middle">
        <tr class="tbl">
            <th>#</th>
            <th>User ID</th>
            <th>Category ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($posts as $post)
        <tr class="tblr">
            <td>{{ $post->id }}</td>
            <td>{{ $post->user_id }}</td>
            <td>{{ $post->category_id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->content }}</td>
            @if (isset($post->image))
            <td><img src="{{ $post->image }}" class="placeholder" alt="Image not found"/></td>
            @else
            <td><img src="{{ asset('image/alternative.png') }}" class="placeholder" alt="Image not found"/></td>
            @endif

            <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <br>
  
    {!! $posts->withQueryString()->links('pagination::bootstrap-5') !!}
      
@endsection

@push('custom-scripts')
<script type="text/javascript">

$(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-dismissible").slideUp(500);
});

</script>
@endpush