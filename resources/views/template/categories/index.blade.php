@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="col-lg-12">
            <h2>Categories</h2>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-12">
            <a class="btn btn-success float-end" href="{{ route('categories.create') }}"> <strong>+</strong> Create New Category</a>
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
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($categories as $category)
        <tr class="tblr">
            <td>{{ $category->id }}</td>
            <td>{{ $category->user_id }}</td>
            <td>{{ $category->name }}</td>

            <td>
                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <br>
  
    {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!}
      
@endsection

@push('custom-scripts')
<script type="text/javascript">

$(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-dismissible").slideUp(500);
});

</script>
@endpush