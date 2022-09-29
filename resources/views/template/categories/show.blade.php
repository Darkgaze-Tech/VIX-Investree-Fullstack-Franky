@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="col-lg-12">
            <h2> Detail Article Category</h2>
        </div>
    </div>
    <div class="row justify-content-center d-grid mx-auto">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('categories') }}">Back</a>
        </div>
    </div>
   <br>

    <div class="row">
        <div class="col">
            <div class="card cards mx-auto">
                <img src="{{ asset('image/alternative.png') }}" class="placeholder card-img-top" alt="Image not found"/>
                <div class="card-body text-center">
                  <h5 class="card-title">{{ $category->name }}</h5>
                </div>
              </div>
        </div>
    </div>
@endsection