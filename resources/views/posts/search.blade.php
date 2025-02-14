
@extends('layouts.app')

@section('search')
<form class="d-flex" method="get" action="{{ route('posts.search') }}" role="search">
    <input class="form-control me-2" name="q"  value="{{ request('q') }}"
    type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
@endsection


@section('content')

    <div class="container mt-5">
      @foreach ( $posts as $post )
        <div class="row my-3">
            <div class="col">
            <div class="card">
  <h5 class="card-header">{{ $post->user->name}} - Created at {{ $post->created_at->format('y-m-d') }}</h5>
  <div class="card-body">
    <h5 class="card-title">{{ $post->title }}</h5>
    <p class="card-text">{{ \Illuminate\Support\Str::limit($post->description,100) }}</p>
    <a href="{{ route("posts.show",$post->id) }}" class="btn btn-primary">Show</a>
  </div>
</div>
            </div>
        </div>
        @endforeach 
      
    </div>

    @endsection
