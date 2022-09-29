@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="col-lg-12">
            <h2> Detail Article Post</h2>
        </div>
    </div>
    <div class="row justify-content-center d-grid mx-auto">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('posts') }}">Back</a>
        </div>
    </div>
   <br>

    <div class="row">
        <div class="col">
            <div class="card cards mx-auto">
                @if (isset($post->image))
                <td><img src="{{ asset($post->image) }}" class="placeholder card-img-top" alt="Image not found"/></td>
                @else
                <td><img src="{{ asset('image/alternative.png') }}" class="placeholder card-img-top" alt="Image not found"/></td>
                @endif
                <div class="card-body text-center">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text">{{ $post->content }}</p>
                </div>
              </div>
        </div>
    </div>
@endsection