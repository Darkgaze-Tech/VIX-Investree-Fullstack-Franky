@extends('layouts.app')

@section('content')

<div class="row text-center">
    <div class="col-lg-12">
        <h2> Add New Article Category</h2>
    </div>
</div>
<div class="row justify-content-center d-grid mx-auto">
    <div class="col-lg-12">
        <a class="btn btn-primary" href="{{ route('categories') }}">Back</a>
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
   
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="form-group">
                <strong>Category name</strong>
                <input type="text" name="name" class="form-control" placeholder="Category">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-5">
                <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
   
</form>
@endsection